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
use Bundle\TicketBundle\Entity\Orders;
use Bundle\TicketBundle\Entity\OrdersHasProducts;


class OrdersController extends GridController
{
	
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
		$varsRepository = $configuration->getRepositoryVars();
		$tree = $configuration->getTree();
		$entity = $configuration->getEntity();
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		//USER
		$user = $this->getUser();
		
		
		//CATEGORY REPOSITORY TREE
		$categoryTreeParent = $this->get('tianos.repository.category')->findAllParentsByType(Category::TYPE_PRODUCT);
		$categoryTree = $this->getTreeEntities($categoryTreeParent, $configuration, 'tree');
		
		
		//PRODUCTS
		$products = $this->get('tianos.repository.pointofsale.has.product')->findByPdv($user->getPointOfSaleActiveId());
		$products = $this->getSerializeDecode($products, $varsRepository->serialize_group_name);
		
		
		//PRODUCT SESSION
		$productSession = $this->getProductSession($request, $varsRepository->serialize_group_name);
		
		if ($form->isSubmitted()) {
			
			try {
				
				$ordersForm = $request->get($varsRepository->serialize_group_name);
				$ordersForm = json_decode(json_encode($ordersForm));

				
				/**
				 * VALIDATE
				 */
				$this->formValidation($request, $varsRepository->serialize_group_name);
				
				
				/**
				 * SAVE OBJECT SALES
				 */
				$entity->setName($ordersForm->name);
				$entity->setDeliveryDate(new \DateTime($ordersForm->deliveryDate));
				$client = $this->get('tianos.repository.user')->find($ordersForm->client);
				$entity->setClient($client);
				$employee = $this->get('tianos.repository.user')->find($user->getId());
				$entity->addEmployee($employee);
				$pdv = $this->get('tianos.repository.pointofsale')->find($user->getPointOfSaleActiveId());
				$entity->setPointOfSale($pdv);
				$this->persist($entity);
				
				
				/**
				 * SAVE TICKET
				 */
				foreach ($request->getSession()->get('products_order') as $key => $productSave) {
					$product = $this->get('tianos.repository.product')->find($productSave['idItem']);
					
					$o = new OrdersHasProducts();
					$o->setOrders($entity);
					$o->setProduct($product);
					$o->setQuantity($productSave['quantity']);
					$o->setUnitPrice($product->getPrice());
					$this->persist($o);
				}
				
				
				//message success
				$this->flashAlertSuccess('Pedido creado. CÓDIGO: <span class="label bg-green-active fontsize-12">' . $entity->getCode() . '</span>');
				
				
				//Remove session
				$request->getSession()->remove('products_order');
				
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
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$template = $configuration->getTemplate('');
		$action = $configuration->getAction();
		$rolesGranted = $configuration->getRolesGranted();
		$formType = $configuration->getFormType();
		$vars = $configuration->getVars();
		
		//IS_GRANTED
		if (!$this->isGranted($rolesGranted)) {
			return $this->render(
				"GridBundle::error.html.twig",
				[
					'message' => self::ACCESS_DENIED_MSG,
				]
			);
		}
		
		//REPOSITORY
		$id = $request->get('id');
		$entity = $this->get($repository)->$method($id);
		$entity = $this->rowImage($entity);
		
		if (!$entity) {
			throw $this->createNotFoundException('CRUD: Unable to find entity.');
		}
		
		//VALIDACION STATUS
		if ($entity->getStatus() == Orders::STATUS_CANCELED) {
			return $this->render(
				"GridBundle::error.html.twig",
				[
					'message' => "El pedido ha sido CANCELADO anteriormente.",
				]
			);
		}
		
		//VALIDACION STATUS
		if ($entity->getStatus() == Orders::STATUS_COMPLETED) {
			return $this->render(
				"GridBundle::error.html.twig",
				[
					'message' => "El pedido ha sido COMPLETADO anteriormente.",
				]
			);
		}
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		if ($form->isSubmitted()) {
			
			$errors = [];
			$status = self::STATUS_ERROR;
			
			try {
				
				if ($form->isValid()) {
					
					$this->persist($entity);
					
					$varsRepository = $configuration->getRepositoryVars();
					$entity = $this->getSerializeDecode($entity, $varsRepository->serialize_group_name);
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
				'id' => $id,
				'status' => $status,
				'errors' => $errors,
				'entity' => $entity,
			]);
		}
		
		return $this->render(
			$template,
			[
				'id' => $id,
				'action' => $action,
				'form' => $form->createView(),
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
		
		$ordersHasProducts = $this->get('tianos.repository.orders.has.products')->findAllBySales($id);
		
		return $this->render(
			$template,
			[
				'action' => $action,
				'entity' => $entity,
				'ordersHasProducts' => $ordersHasProducts,
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
		$varsRepository = $configuration->getRepositoryVars();
		$entity = $configuration->getEntity();
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		//BUSCA LOS CLIENTES DEL PDV
		$clients = $this->get($repository)->$method();
		$clients = $this->getSerializeDecode($clients, $varsRepository->serialize_group_name);
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$clientId = $request->get('client');
			$clientId = (int) array_shift($clientId);
			
			$client = $this->get('tianos.repository.user')->findOneById($clientId);
			$client = $this->getSerializeDecode($client, $varsRepository->serialize_group_name);
			
			return $this->render(
				'TicketBundle:Orders/Grid/Box:table_client.html.twig',
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
		
		//REMOVE SESSION
		$request->getSession()->remove('products_order');
		
		return $this->render(
			$template,
			[
				'status' => self::STATUS_SUCCESS,
				'productSession' => []
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
		$varsRepository = $configuration->getRepositoryVars();
		
		//GUARDAR SESSION PRODUCTS
		$this->incrementDecrementSession($request, $request->get('action'));
		
		$productSession = [];
		foreach ($request->getSession()->get('products_order') as $key => $product) {
			$obj = $this->get('tianos.repository.product')->find($product['idItem']);
			$obj->setQuantity($product['quantity']);
			$productSession[] = $this->getSerializeDecode($obj, $varsRepository->serialize_group_name);
		}
		
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
	private function incrementDecrementSession(Request $request, $action = Orders::INCREMENT)
	{
		
		//SESSION
		$idItem = $request->get('idItem');
		
		$session = $request->getSession();
		
		$products = $session->get('products_order');
		
		if (is_null($products)) {
			$session->set('products_order', []);
		}
		
		$products = $session->get('products_order');
		
		$exist = false;
		foreach ($products as $key => $product) {
			
			if ($product['idItem'] == $idItem) {
				
				if ($action == Orders::DECREMENT AND $product['quantity'] >= 1) {
					$array[] = [
						'idItem' => $idItem,
						'quantity' => --$product['quantity']
					];
				}
				
				if ($action == Orders::INCREMENT) {
					$array[] = [
						'idItem' => $idItem,
						'quantity' => ++$product['quantity']
					];
				}
				
				unset($products[$key]);
				$session->set('products_order', array_merge($products, $array));
				
				$exist = true;
				break;
			}
		}
		
		$products = $session->get('products_order');
		
		// QUITAR CON ZEROS
		foreach ($products as $key => $product) {
			if ($product['quantity'] == 0) {
				unset($products[$key]);
				$session->set('products_order', $products);
			}
		}

		if (!$exist) {
			$session->set('products_order', array_merge($products, [
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
	
	private function getProductSession(Request $request, $groupName)
	{
		$productSession = [];
		
		if (!empty($request->getSession()->get('products_order'))) {
			foreach ($request->getSession()->get('products_order') as $key => $product) {
				$obj = $this->get('tianos.repository.product')->find($product['idItem']);
				
				if (is_null($obj)) {
					continue;
				}
				
				$obj->setQuantity($product['quantity']);
				$productSession[] = $this->getSerializeDecode($obj, $groupName);
			}
		}
		
		return array_filter($productSession);
	}
	
	private function formValidation(Request $request, $groupName)
	{
		$ordersForm = json_decode(json_encode($request->get($groupName)));
		
		if (empty($ordersForm->client)) {
			throw new \Exception("Seleccione un cliente.");
		}

		if (empty($ordersForm->deliveryDate)) {
			throw new \Exception("Seleccione la Fecha de entrega.");
		}
		
		if (empty($request->getSession()->get('products_order'))) {
			throw new \Exception("Seleccione al menos un producto.");
		}
		
	}
}
