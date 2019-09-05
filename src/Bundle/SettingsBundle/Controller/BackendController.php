<?php

declare(strict_types=1);

namespace Bundle\SettingsBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\SettingsBundle\Entity\Settings;

use Bundle\TicketBundle\Services\Escpos\Printer;
use Bundle\TicketBundle\Services\Escpos\PrintConnectors\FilePrintConnector;

class BackendController extends BaseController
{
	
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function printReceiptAction(Request $request): Response
	{
		
		//SETTINGS SALES_UNIT
		$printerFilename = $this->get('tianos.repository.settings')->findByClassName(Settings::PRINTER_FILENAME);
		
		
//		localhost:631
//		php://stdout
		
		$connector = new FilePrintConnector($printerFilename);
		$printer = new Printer($connector);
		
		$printer->text("Hello World - POLLAZO!\n");
		$printer->cut();
		
		$printer->close();
		
		
		
		return new Response(1);
	}
	
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function editAction(Request $request): Response
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
		$action = $configuration->getAction();
		$rolesGranted = $configuration->getRolesGranted();
		$formType = $configuration->getFormType();
		$vars = $configuration->getVars();
		$entity = $configuration->getEntity();
		$entity = new $entity();
		
		//IS_GRANTED
		if (!$this->isGranted($rolesGranted)) {
			return $this->render(
				"GridBundle::error.html.twig",
				[
					'message' => self::ACCESS_DENIED_MSG,
				]
			);
		}
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		$errors = [];
		
		if ($form->isSubmitted()) {
			
			try {
				
				if ($form->isValid()) {
					
					$this->get($repository)->deleteAll();
					
					$o = new $entity();
					$o->setClassName(Settings::SYSTEM_EMAIL);
					$o->setClassValue((string) $entity->getSystemEmail());
					$this->persist($o);
					
					$o = new $entity();
					$o->setClassName(Settings::SALES_QUANTITY);
					$o->setClassValue((string) $entity->getSalesQuantity());
					$this->persist($o);
					
					$o = new $entity();
					$o->setClassName(Settings::SALES_QUANTITY_PRICE_X);
					$o->setClassValue((string) $entity->getSalesQuantityPriceX());
					$this->persist($o);
					
					$o = new $entity();
					$o->setClassName(Settings::PRINTER_FILENAME);
					$o->setClassValue((string) $entity->getPrinterFilename());
					$this->persist($o);
					
				} else {
					foreach ($form->getErrors(true) as $key => $error) {
						if ($form->isRoot()) {
							$errors[] = $error->getMessage();
						} else {
							$errors[] = $error->getMessage();
						}
					}
				}
				
			} catch (\Exception $e) {
				$errors[] = $e->getMessage();
			}
		}
		
		//REPOSITORY
//		$entities = $this->get($repository)->$method();
		
		return $this->render(
			$template,
			[
				'vars' => $vars,
				'errors' => $errors,
				'action' => $action,
				'form' => $form->createView(),
			]
		);
	}
	
}
