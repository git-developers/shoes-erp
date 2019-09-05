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
use Bundle\TicketBundle\Entity\Sales;
use Bundle\TicketBundle\Entity\OrdersHasProducts;
use Bundle\TicketBundle\Entity\SalesHasProducts;
use Bundle\SettingsBundle\Entity\Settings;
use Bundle\TicketBundle\Entity\PaymentHistory;


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
		
		
		//POINT OF SALE VALIDACION
		if ($user->isPointOfSaleActiveStatusClosed()) {
			return $this->render(
				"TicketBundle:Sales/Grid:error.html.twig",
				[
					'vars' => $vars,
				]
			);
		}
		
		
		//CATEGORY REPOSITORY TREE
		$categoryTreeParent = $this->get('tianos.repository.category')->findAllParentsByType(Category::TYPE_PRODUCT);
		$categoryTree = $this->getTreeEntities($categoryTreeParent, $configuration, 'tree');
		
		
		//PRODUCTS
		$products = $this->get('tianos.repository.pointofsale.has.product')->findByPdv($user->getPointOfSaleActiveId());
		$products = $this->getSerializeDecode($products, $varsRepository->serialize_group_name);
		
		
		//PRODUCT SESSION
		$productSession = $this->getProductSession($request, $varsRepository->serialize_group_name);
		
		
		//SETTINGS SALES_UNIT
		$salesQuantityPriceX = $this->get('tianos.repository.settings')->findByClassName(Settings::SALES_QUANTITY_PRICE_X);
		
		
		if ($form->isSubmitted()) {
			
			try {
				
				$ordersForm = $request->get($varsRepository->serialize_group_name);
				$ordersForm = json_decode(json_encode($ordersForm));
				
				/**
				 * VALIDATE
				 */
				$this->formValidation($request, $varsRepository->serialize_group_name);
				
				
				/**
				 * SAVE OBJECT ORDER
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
				 * SAVE -> ORDER HAS PRODUCTS
				 */
				$subTotal = 0;
				foreach ($request->getSession()->get('products_order') as $key => $productSave) {
					$product = $this->get('tianos.repository.product')->find($productSave['idItem']);
					
					$o = new OrdersHasProducts();
					$o->setOrders($entity);
					$o->setProduct($product);
					$o->setPdvHash($pdv->getPdvHash());
					$o->setQuantity((float) $productSave['quantity']);
					$o->setUnitPrice($product->getPrice());
					$this->persist($o);
					
					
					//SUM SUB TOTAL
					$subTotal += $product->getPrice() * $productSave['quantity'] * $salesQuantityPriceX;
				}
				
				
				/**
				 * UPDATE OBJECT SALES
				 */
				$entity->setTotal($subTotal);
				$this->persist($entity);
				
				
				/**
				 * MESSAGE SUCCESS
				 */
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
				'salesQuantityPriceX' => $salesQuantityPriceX,
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
		
		if (!$entity) {
			throw $this->createNotFoundException('CRUD: Unable to find entity.');
		}
		
		//VALIDACION STATUS
		if ($entity->getStatus() == Orders::STATUS_VOIDED) {
			return $this->render(
				"GridBundle::error.html.twig",
				[
					'message' => "El pedido ha sido ANULADO anteriormente.",
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
					$this->saveObject($entity);
					
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
	
	private function saveObject(Orders $order)
	{
		try {
		
			if ($order->getStatus() != Orders::STATUS_COMPLETED) {
				return false;
			}
			
			
			/**
			 * SAVE OBJECT SALES
			 */
			if (!is_null($order->getClient())) {
				$sales = new Sales();
				$sales->setTotal($order->getTotal());
				$sales->setName($order->getName());
				$sales->setDeliveryDate(new \DateTime($order->getDeliveryDate()));
				$sales->setClient($order->getClient());
				$sales->setPointOfSale($order->getPointOfSale());
				$sales->setStatus(Sales::STATUS_READY_FOR_SALE);
				
				foreach ($order->getEmployee() as $key => $employee) {
					$sales->addEmployee($employee);
				}
				
				$this->persist($sales);
			}
			
			
			$ordersHasProducts = $this->get('tianos.repository.orders.has.products')->findAllBySales($order->getId());
			
			foreach ($ordersHasProducts as $key => $oHp) {
				
				/**
				 * REPORT PDV UPDATE
				 */
				$reportPdv = $this->get('tianos.repository.report.pdv')->findByHashAndProduct(
					$oHp->getPdvHash(),
					$oHp->getProduct()->getId()
				);
				$reportPdv->setStockOrders($reportPdv->getStockOrders() + $oHp->getQuantity());
				$this->persist($reportPdv);
				
				
				/**
				 * UPDATE POINTOFSALE HAS PRODUCT
				 */
				$pointofsaleHasProduct = $this->get('tianos.repository.pointofsale.has.product')->findByPdvAndProduct(
					$order->getPointOfSale()->getId(),
					$oHp->getProduct()->getId()
				);
				$pointofsaleHasProduct->setStock($pointofsaleHasProduct->getStock() + $oHp->getQuantity());
				$this->persist($pointofsaleHasProduct);
				
				
				if (is_null($order->getClient())) {
					continue;
				}
				
				/**
				 * SALES HAS PRODUCTS
				 */
				$o = new SalesHasProducts();
				$o->setSales($sales);
				$o->setProduct($oHp->getProduct());
				$o->setQuantity((float) $oHp->getQuantity());
				$o->setUnitPrice($oHp->getProduct()->getPrice());
				$this->persist($o);
			}
			
			if (is_null($order->getClient())) {
				return false;
			}
			
			/**
			 * PAYMENT HISTORY
			 */
			$o = new PaymentHistory();
			$o->setSales($sales);
			$o->setSubTotal($order->getTotal());
			$o->setTotal($order->getTotal());
			$o->setDiscount(0);
			$o->setPayment(0);
			$o->setChangeBack(0);
			$o->setPaymentCollected(0);
			$o->setReceivedDate(new \DateTime());
			$o->setPaymentType($this->get('tianos.repository.payment.type')->find(3));
			$this->persist($o);
			
		} catch (\Exception $e) {
		
		}
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
		
		//SETTINGS SALES_UNIT
		$salesQuantityPriceX = $this->get('tianos.repository.settings')->findByClassName(Settings::SALES_QUANTITY_PRICE_X);
		
		return $this->render(
			$template,
			[
				'action' => $action,
				'entity' => $entity,
				'ordersHasProducts' => $ordersHasProducts,
				'salesQuantityPriceX' => $salesQuantityPriceX,
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
	public function addPdvAction(Request $request): Response
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
		
		//BUSCA PDV
		$pointsOfSale = $this->get($repository)->$method();
		$pointsOfSale = $this->getSerializeDecode($pointsOfSale, $varsRepository->serialize_group_name);
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$pdvId = $request->get('pdv');
			$pdvId = (int) array_shift($pdvId);
			
			$pdv = $this->get('tianos.repository.pointofsale')->find($pdvId);
			$pdv = $this->getSerializeDecode($pdv, $varsRepository->serialize_group_name);
			
			return $this->render(
				'TicketBundle:Orders/Grid/Box:table_pointofsale.html.twig',
				[
					'status' => $pdv ? self::STATUS_SUCCESS : self::STATUS_ERROR,
					'pdv' => $pdv
				]
			);
		}
		
		return $this->render(
			$template,
			[
				'action' => $action,
				'pointsOfSale' => $pointsOfSale,
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
		
		
		//SETTINGS SALES_UNIT
		$salesQuantity = $this->get('tianos.repository.settings')->findByClassName(Settings::SALES_QUANTITY);
		$salesQuantityPriceX = $this->get('tianos.repository.settings')->findByClassName(Settings::SALES_QUANTITY_PRICE_X);
		
		if (!is_null($request->get('idItem'))) {
			//GUARDAR SESSION PRODUCTS
			$this->incrementDecrementSession($request, $request->get('action'), $salesQuantity);
		}
		
		$productSession = [];
		foreach ($request->getSession()->get('products_order') as $key => $product) {
			$obj = $this->get('tianos.repository.product')->find($product['idItem']);
			$obj->setQuantity((float) $product['quantity']);
			$productSession[] = $this->getSerializeDecode($obj, $varsRepository->serialize_group_name);
		}
		
		return $this->render(
			$template,
			[
				'productSession' => $productSession,
				'salesQuantityPriceX' => $salesQuantityPriceX
			]
		);
	}
	
	/**
	 * Session products
	 *
	 * @param Request $request
	 * @param string $action
	 */
	private function incrementDecrementSession(Request $request, $action = Orders::INCREMENT, $salesQuantity)
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
				
				if ($action == Orders::DECREMENT AND $product['quantity'] >= $salesQuantity) {
					$array[] = [
						'idItem' => $idItem,
						'quantity' => $product['quantity'] - $salesQuantity,
					];
				}else if ($action == Orders::INCREMENT) {
					$array[] = [
						'idItem' => $idItem,
						'quantity' => $product['quantity'] + $salesQuantity,
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
					'quantity' => $salesQuantity,
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
				
				$obj->setQuantity((float) $product['quantity']);
				$productSession[] = $this->getSerializeDecode($obj, $groupName);
			}
		}
		
		return array_filter($productSession);
	}
	
	private function getOrderSubTotal(Request $request)
	{
		$subTotal = 0;
		
		//SETTINGS SALES_UNIT
		$salesQuantityPriceX = $this->get('tianos.repository.settings')->findByClassName(Settings::SALES_QUANTITY_PRICE_X);
		
		foreach ($request->getSession()->get('products_order') as $key => $productSave) {
			$product = $this->get('tianos.repository.product')->find($productSave['idItem']);
			$subTotal += $product->getPrice() * (float) $productSave['quantity'] * $salesQuantityPriceX;
		}
		
		return $subTotal;
	}
	
	private function formValidation(Request $request, $groupName)
	{
		$ordersForm = json_decode(json_encode($request->get($groupName)));

		if (empty($ordersForm->deliveryDate)) {
			throw new \Exception("Seleccione la Fecha de entrega.");
		}
		
		if (empty($request->getSession()->get('products_order'))) {
			throw new \Exception("Seleccione al menos un producto.");
		}
		
		if ($ordersForm->discount > $this->getOrderSubTotal($request)) {
			throw new \Exception("El descuento no puede ser mayor al Importe Total.");
		}
	}
}
