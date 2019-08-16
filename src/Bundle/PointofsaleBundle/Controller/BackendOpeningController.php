<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Controller;

use Webmozart\Assert\Assert;
use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\CoreBundle\Command\PointofsaleOpeningCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Bundle\PointofsaleBundle\Entity\PointofsaleOpening;


class BackendOpeningController extends GridController
{
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function indexAction(Request $request): Response
	{
		
		$parameters = [
			'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
		];
		$applicationName = $this->container->getParameter('application_name');
		$this->metadata = new Metadata('tianos', $applicationName, $parameters);
		
		//CONFIGURATION
		$configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$template = $configuration->getTemplate('');
		$grid = $configuration->getGrid();
		$vars = $configuration->getVars();
		$modal = $configuration->getModal();
		$rolesGranted = $configuration->getRolesGranted();
		$formType = $configuration->getFormType();
		$entity = $configuration->getEntity();
		$entity = new $entity();
		
		
		//IS_GRANTED
		$this->denyAccessUnlessGranted($rolesGranted, null, self::ACCESS_DENIED_MSG);
		
		
		//GRID
		$gridService = $this->get('tianos.grid');
		$modal = $gridService->getModalMapper()->getDefaults($modal);
		
		
		//PDV
		$pdvId = $request->get('id');
		$pdv = $this->get('tianos.repository.pointofsale')->find($pdvId);
		
		
		//FORM
		$form = $this->createForm($formType, $entity, [
			'form_data' => [],
		]);
		$form->handleRequest($request);

		if ($form->isSubmitted()) {
		
		}
		
		return $this->render(
			$template,
			[
				'pdv' => $pdv,
				'vars' => $vars,
				'grid' => $grid,
				'modal' => $modal,
				'form' => $form->createView(),
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Exception
	 */
	public function createAction(Request $request): Response
	{
		
		if ($request->isMethod('POST')) {
			
			$pdvId = $request->get('id');
			
			$pdv = $this->get('tianos.repository.pointofsale')->find($pdvId);
			
			
			/**
			 * CLOSING PDV
			 */
			if ($pdv->getStatus() == Pointofsale::STATUS_OPEN) {
				
				/**
				 * UPDATE OPENING PDV
				 */
				$o = $this->get('tianos.repository.pointofsale.opening')->findOneByHash($pdv->getPdvHash());
				$o->setClosingDate(new \DateTime("NOW"));
				$this->persist($o);
				
				
				/**
				 * UPDATE PDV
				 */
				$pdv->setStatus(Pointofsale::STATUS_CLOSED);
				$pdv->setPdvHash(null);
				$this->persist($pdv);
				
				return new Response(1);
			}
			
			
			//truncate tables
			$command = new PointofsaleOpeningCommand();
			$command->setContainer($this->container);
			$input = new ArrayInput(['pdvId' => $pdvId]);
			$output = new BufferedOutput();
			$resultCode = $command->run($input, $output);
			
			$content = $output->fetch();
			//load fixtures
			
			return $this->json([
				'content' => $content,
			]);
		}
		
		$options = $request->attributes->get('_tianos');
		
		$template = $options['template'] ?? null;
		Assert::notNull($template, 'Template is not configured.');
		
		return $this->render(
			$template,
			[
				'value' => null,
			]
		);
	}
}
