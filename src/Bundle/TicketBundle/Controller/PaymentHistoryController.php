<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\CategoryBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Session\Session;
use Bundle\TicketBundle\Entity\Sales;
use Bundle\TicketBundle\Entity\PaymentHistory;
use Bundle\TicketBundle\Entity\SalesHasProducts;


class PaymentHistoryController extends GridController
{
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function indexAction(Request $request): Response
	{
		if (!$this->isXmlHttpRequest()) {
			throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
		}
		
		$parameters = [
			'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
		];
		$applicationName = $this->container->getParameter('application_name');
		$this->metadata = new Metadata('tianos', $applicationName, $parameters);
		
		//CONFIGURATION
		$configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
		$template = $configuration->getTemplate('');
		$action = $configuration->getAction();
		$formType = $configuration->getFormType();
		$vars = $configuration->getVars();
		$varsRepository = $configuration->getRepositoryVars();
		$tree = $configuration->getTree();
		$entity = $configuration->getEntity();
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		
		//REPOSITORY
		$salesId = $request->get('id');
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$paymentHistory = $this->get($repository)->$method($salesId);
		
		//SALES OBJECT
		$sales = $this->get('tianos.repository.sales')->find($salesId);
		
		if ($form->isSubmitted()) {
			
			$errors = [];
			$entityJson = null;
			$status = self::STATUS_ERROR;
			
			try {
				
				if ($form->isValid()) {
					
					$salesId = $entity->getSalesId();
					
					$sales = $this->get('tianos.repository.sales')->find($salesId);
					$entity->setSales($sales);
					$entity->setChangeBack( empty($entity->getChangeBack()) ? 0 : $entity->getChangeBack() );
					$entity->setPaymentCollected($entity->getPayment() - $entity->getChangeBack());
					$entity->setReceivedDate(new \DateTime());
					$this->persist($entity);
					
					/**
					 * UPDATE SALES STATUS
					 */
					$paymentHistory = $this->get($repository)->$method($salesId);
					$sales = $this->updateSalesStatus($sales, $paymentHistory);
					
					$varsRepository = $configuration->getRepositoryVars();
					$sales = $this->getSerializeDecode($sales, $varsRepository->serialize_group_name);
					$status = self::STATUS_SUCCESS;
					
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
			
			return $this->json([
				'id' => $salesId,
				'status' => $status,
				'errors' => $errors,
				'entity' => $sales,
			]);
		}
		
		return $this->render(
			$template,
			[
				'action' => $action,
				'entity' => $sales,
				'form' => $form->createView(),
				'paymentHistory' => $paymentHistory,
			]
		);
	}
	
	private function sumPayment(array $paymentHistory): float
	{
		$total = 0;
		foreach ($paymentHistory as $key => $pH) {
			$total += $pH->getPayment() - $pH->getChangeBack();
		}
		
		return $total;
	}
	
	private function updateSalesStatus(Sales $sales, array $paymentHistory): Sales
	{
		
		if ($this->sumPayment($paymentHistory) >= $sales->getTotal()) {
			$sales->setStatus(Sales::STATUS_CANCELED);
			$this->persist($sales);
		}
		
		return $sales;
	}
	
}
