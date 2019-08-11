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
use Bundle\TicketBundle\Entity\TicketHasProducts;
use Bundle\TicketBundle\Entity\Ticket;

class SalesController extends GridController
{

	const INCREMENT = 'INCREMENT';
	const DECREMENT = 'DECREMENT';
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function createAction(Request $request): Response
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
		$formType = $configuration->getFormType();
		$vars = $configuration->getVars();
		$tree = $configuration->getTree();
		$entity = $configuration->getEntity();
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		//USER
		$user = $this->getUser();
		
		
		//CATEGORY AND PRODUCT - REPOSITORY TREE
		$categoryTreeParent = $this->get('tianos.repository.category')->findAllParentsByType(Category::TYPE_PRODUCT);
		$categoryTree = $this->getTreeEntities($categoryTreeParent, $configuration, 'tree');
		
//		$byReference = [];
//		$productsObjs = $this->getProducts($categoryTreeParent, $configuration, 'ticket', $byReference);
		//CATEGORY AND PRODUCT - REPOSITORY TREE
		
		
		//PRODUCTS SESSION
		$productSession = [];
		$session = $request->getSession();

		if (!empty($session->get('products'))) {
			foreach ($session->get('products') as $key => $product) {
				$serviceObj = $this->get('tianos.repository.product')->find($product['idItem']);
				$serviceObj->setQuantity($product['quantity']);
				$productSession[] = $this->getSerializeDecode($serviceObj, 'ticket');
			}
			
			$productSession = array_filter($productSession);
		}
		//PRODUCTS SESSION
		
		
//		echo "POLLO:: <pre>";
//		print_r(array_filter($productSession));
//		exit;

		
		
		
		//PRODUCTS
		$products = $this->get('tianos.repository.pointofsale.has.product')->findByPdv($user->getPointOfSaleActiveId());
		$products = $this->getSerializeDecode($products, 'sales');
		
		
		
		if ($form->isSubmitted()) {
			
			try {
				
				$ticket = $request->get('ticket');
				$ticket = json_decode(json_encode($ticket));
				
				$session = $request->getSession();
				$productsSession = $session->get('products');
				
				if (empty($ticket->client)) {
					return $this->json([
						'status' => false,
						'message' => 'Seleccione un cliente.'
					]);
				}
				
				/*
				if (empty($ticket->dateTicket)) {
					return $this->json([
						'status' => false,
						'message' => 'Ingrese la fecha.'
					]);
				}
				*/
				
				if (empty($productsSession)) {
					return $this->json([
						'status' => false,
						'message' => 'Seleccione al menos un producto.'
					]);
				}
				
				if (empty($ticket->name)) {
					return $this->json([
						'status' => false,
						'message' => 'Ingrese una descripcion.'
					]);
				}
				

				
				
				/**
				 * SAVE OBJECT
				 */
				$entity->setName($ticket->name);
				$entity->setDateTicket(new \DateTime());
				
				$client = $this->get('tianos.repository.user')->find($ticket->client);
				$entity->setClient($client);
				
				$employee = $this->get('tianos.repository.user')->find($user->getId());
				$entity->addEmployee($employee);
				
				$this->persist($entity);
				
				
				/**
				 * SAVE TICKET
				 */
				foreach ($productsSession as $key => $product) {
					$product = $this->get('tianos.repository.product')->find($product['idItem']);
					
					$ticketHasService = new TicketHasProducts();
					$ticketHasService->setProducts($product);
					$ticketHasService->setTicket($entity);
					$ticketHasService->setQuantity($product->getQuantity());
					$ticketHasService->setUnitPrice($product->getPrice());
					$ticketHasService->setSubTotal($product->getPrice() * $product->getQuantity());
					$this->persist($ticketHasService);
				}
				/**
				 * SAVE TICKET
				 */
				
				
				$this->flashAlertSuccess('Se creo el ticket.');
				
				//Remove session
				$session = $request->getSession();
				$session->remove('products');
				
				return $this->json([
					'status' => true
				]);
				
			} catch (\Exception $e) {
				return $this->json([
					'status' => false,
					'message' => $e->getMessage()
				]);
			}
			
		}
		
		return $this->render(
			$template,
			[
				'tree' => $tree,
				'vars' => $vars,
				'action' => $action,
				'categoryTree' => $categoryTree,
				'products' => $products,
				'productSession' => $productSession,
				'form' => $form->createView()
			]
		);
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
		$formType = $configuration->getFormType();
		$vars = $configuration->getVars();
		$tree = $configuration->getTree();
		$entity = $configuration->getEntity();
		
//		$entity = new $entity();
		//REPOSITORY
		$id = $request->get('id');
		$entity = $this->get($repository)->$method($id);
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		//USER
		$user = $this->getUser();
		
		
		//REPOSITORY TREE
		//$categoryTreeParent = $this->get('tianos.repository.category')->findAllParentsByType($user->getPointOfSaleActiveId(), Category::TYPE_SERVICE);
		$categoryTreeParent = $this->get('tianos.repository.category')->findAllParentsByType(Category::TYPE_PRODUCT);
		$categoryTree = $this->getTreeEntities($categoryTreeParent, $configuration, 'tree');
		
		$servicesArray = [];
		$servicesObjs = $this->getServices($categoryTreeParent, $configuration, 'ticket', $servicesArray);
		//REPOSITORY TREE
		
		
		//SESSION PRODUCTS
//		$productArray = [];
//		$session = $request->getSession();
//		$products = $session->get('products');
//		//$session->remove('products');
//
//		if (!empty($products)) {
//			foreach ($products as $key => $product) {
//				$serviceObj = $this->get('tianos.repository.product')->find($product['idItem']);
//				$serviceObj->setQuantity($product['quantity']);
//				$productArray[] = $this->getSerializeDecode($serviceObj, 'ticket');
//			}
//		}
		//SESSION PRODUCTS
		
		
		//PRODUCTS
		$productArray = $this->get('tianos.repository.product')->findAll();
		$productArray = $this->getSerializeDecode($productArray, 'ticket');
		//PRODUCTS
		
		
		
		if ($form->isSubmitted()) {
			
			try {
				
				$ticket = $request->get('ticket');
				$ticket = json_decode(json_encode($ticket));
				
				$session = $request->getSession();
				$idClient = $session->get('id_client');
				$idEmployees = $session->get('id_employee');
				$products = $session->get('products');
				
				if (empty($idClient)) {
					return $this->json([
						'status' => false,
						'message' => 'Seleccione un cliente.'
					]);
				}
				
				if (empty($idEmployees)) {
					return $this->json([
						'status' => false,
						'message' => 'Seleccione al menos un empleado.'
					]);
				}
				
				if (empty($products)) {
					return $this->json([
						'status' => false,
						'message' => 'Seleccione al menos un servicio.'
					]);
				}
				
				if (empty($ticket->name)) {
					return $this->json([
						'status' => false,
						'message' => 'Ingrese un nombre.'
					]);
				}
				
				if (empty($ticket->dateTicket)) {
					return $this->json([
						'status' => false,
						'message' => 'Ingrese la fecha.'
					]);
				}
				
				
				$entity->setName($ticket->name);
				$entity->setDateTicket(new \DateTime($ticket->dateTicket));
				
				$client = $this->get('tianos.repository.user')->find($idClient);
				$entity->setClient($client);
				
				foreach ($idEmployees as $key => $idEmployee) {
					$employee = $this->get('tianos.repository.user')->find($idEmployee);
					$entity->addUser($employee);
				}
				
				foreach ($products as $key => $product) {
					$product = $this->get('tianos.repository.services')->find($product['idItem']);
					$entity->addServices($product);
				}
				
				$this->persist($entity);
				
				$this->flashAlertSuccess('Se creo el ticket.');
				
				//Remove session
				$session = $request->getSession();
				$session->remove('id_client');
				$session->remove('id_employee');
				$session->remove('services');
				
				return $this->json([
					'status' => true
				]);
				
			} catch (\Exception $e) {
				return $this->json([
					'status' => false,
					'message' => $e->getMessage()
				]);
			}
			
		}
		
		return $this->render(
			$template,
			[
				'tree' => $tree,
				'vars' => $vars,
				'action' => $action,
				'servicesObjs' => $servicesObjs,
				'categoryTree' => $categoryTree,
				'products' => $productArray,
				'entity' => $entity
//				'form' => $form->createView(),
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function viewAction(Request $request): Response
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
		
		//REPOSITORY
		$id = $request->get('id');
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$entity = $this->get($repository)->$method($id);
		
		if (!$entity) {
			throw $this->createNotFoundException('CRUD: Unable to find  entity.');
		}
		
		$ticketHasProducts = $this->get('tianos.repository.ticket.products')->findAllByTicket($id);
		
		return $this->render(
			$template,
			[
				'action' => $action,
				'entity' => $entity,
				'ticketHasProducts' => $ticketHasProducts,
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function addClienteAction(Request $request): Response
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
		$entity = $configuration->getEntity();
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		
		//USER
		$user = $this->getUser();
		
		//BUSCA LOS CLIENTES DEL PDV
		//$clients = $this->get('tianos.repository.user')->findAllClient($user->getPointOfSaleActiveId());
		$clients = $this->get($repository)->$method();
		//$clients = is_object($clients) ? $clients->getUser() : [];
		$clients = $this->getSerializeDecode($clients, 'ticket');
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$client = $request->get('client');
			$client = (int) array_shift($client);
			
			$client = $this->get('tianos.repository.user')->findOneById($client);
			$client = $this->getSerializeDecode($client, 'ticket');
			
			return $this->render(
				'TicketBundle:BackendTicket/Grid/Box:table_client.html.twig',
				[
					'status' => $client ? self::STATUS_SUCCESS : self::STATUS_ERROR,
					'client' => $client
				]
			);
		}
		
		return $this->render(
			$template,
			[
				'clients' => $clients,
				'action' => $action,
				'form' => $form->createView(),
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function removeAllItemAction(Request $request): Response
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
		
		$session = $request->getSession();
		$session->remove('products');
		
		return $this->render(
			$template,
			[
				'status' => self::STATUS_SUCCESS,
				'products' => []
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function incrementDecrementItemAction(Request $request): Response
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
		
		//GUARDAR SESSION PRODUCTS
		$this->incrementDecrementSession($request, $request->get('action'));
		
		$productSession = [];
		foreach ($request->getSession()->get('products') as $key => $product) {
			$obj = $this->get('tianos.repository.product')->find($product['idItem']);
			$obj->setQuantity($product['quantity']);
			$productSession[] = $this->getSerializeDecode($obj, 'ticket');
		}
		
		
		echo "POLLO:: <pre>";
		print_r($productSession);
		exit;
		
		
		
		return $this->render(
			$template,
			[
				'productSession' => $productSession
			]
		);
	}
	
	/**
	 * Session products
	 *
	 * @param Request $request
	 * @param string $action
	 */
	private function incrementDecrementSession(Request $request, $action = self::INCREMENT)
	{
		
		//SESSION
		$idItem = $request->get('idItem');
		
		$session = $request->getSession();
		
		$products = $session->get('products');
		
		if (is_null($products)) {
			$session->set('products', []);
		}
		
		$products = $session->get('products');
		
		$exist = false;
		foreach ($products as $key => $product) {
			
			if ($product['idItem'] == $idItem) {
				
				if ($action == self::DECREMENT AND $product['quantity'] >= 1) {
					$array[] = [
						'idItem' => $idItem,
						'quantity' => --$product['quantity']
					];
				}
				
				if ($action == self::INCREMENT) {
					$array[] = [
						'idItem' => $idItem,
						'quantity' => ++$product['quantity']
					];
				}
				
				unset($products[$key]);
				$session->set('products', array_merge($products, $array));
				
				$exist = true;
				break;
			}
		}
		
		$products = $session->get('products');
		
		// QUITAR CON ZEROS
		foreach ($products as $key => $product) {
			if ($product['quantity'] == 0) {
				unset($products[$key]);
				$session->set('products', $products);
			}
		}

		if (!$exist) {
			$session->set('products', array_merge($products, [
				[
					'idItem' => $idItem,
					'quantity' => 1,
				]
			]));
		}
	}
	
	private function getTreeEntities($parents, $configuration, $serializeGroupName)
	{
		if (is_null($parents)) {
			$parents = [];
		}
		
		$entity = [];
		foreach ($parents as $key => $parent) {
			$entity[$key]['parent'] = $this->getSerializeDecode($parent, $serializeGroupName);
			$children = $this->get('tianos.repository.category')->findAllByParent($parent);
			$entity[$key]['children'] = $this->getTreeEntities($children, $configuration, $serializeGroupName);
		}
		
		return $entity;
	}
	
	private function getProducts($parents, $configuration, $serializeGroupName, &$entity)
	{
		if (is_null($parents)) {
			$parents = [];
		}
		
		foreach ($parents as $key => $parent) {
			
			$products = $this->get('tianos.repository.product')->findAllByCategory($parent);
			$products = $this->rowImages($products);
			$result_1 = $this->getSerializeDecode($products, $serializeGroupName);
			
			$children = $this->get('tianos.repository.category')->findAllByParent($parent);
			$result_2 = $this->getProducts($children, $configuration, $serializeGroupName, $entity);
			
			$entity = array_merge($result_1, $result_2);
		}
		
		
		return $entity;
	}
	
}
