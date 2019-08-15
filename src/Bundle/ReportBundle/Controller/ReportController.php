<?php

declare(strict_types=1);

namespace Bundle\ReportBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;


class ReportController extends BaseController
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
		$template = $configuration->getTemplate('');
		$action = $configuration->getAction();
		$vars = $configuration->getVars();
		$modal = $configuration->getModal();
		$formType = $configuration->getFormType();
		$entity = $configuration->getEntity();
		
		//MODAL
		$gridService = $this->get('tianos.grid');
		$modal = $gridService->getModalMapper()->getDefaults($modal);
		
		//FORM
		$entity = new $entity();
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		$reportPdvs = null;
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$reportPdvs = $this->get('tianos.repository.report.pdv')->findAllByPdvAndDate(
				$entity->getPointOfSale()->getId(),
				$entity->getOpeningDate()
			);

		}
		
		return $this->render(
			$template,
			[
				'vars' => $vars,
				'modal' => $modal,
				'action' => $action,
				'reportPdvs' => $reportPdvs,
				'form' => $form->createView(),
			]
		);
	}
	
	
}
