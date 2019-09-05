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
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Bundle\SettingsBundle\Entity\Settings;

use Bundle\TicketBundle\Services\Escpos\Printer;
use Bundle\TicketBundle\Services\Escpos\PrintConnectors\FilePrintConnector;


class SalesController extends GridController
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
				
				$salesForm = $request->get($varsRepository->serialize_group_name);
				$salesForm = json_decode(json_encode($salesForm));
				
				
				/**
				 * VALIDATE
				 */
				$this->formValidation($request, $varsRepository->serialize_group_name);
				
				
				/**
				 * SAVE OBJECT SALES
				 */
				$entity->setName($salesForm->name);
				$entity->setDeliveryDate(new \DateTime($salesForm->deliveryDate));
				$client = $this->get('tianos.repository.user')->find($salesForm->client);
				$entity->setClient($client);
				$employee = $this->get('tianos.repository.user')->find($user->getId());
				$entity->addEmployee($employee);
				$pdv = $this->get('tianos.repository.pointofsale')->find($user->getPointOfSaleActiveId());
				$entity->setPointOfSale($pdv);
				$entity->setStatus(Sales::STATUS_OPEN);
				$this->persist($entity);
				
				
				/**
				 * SAVE -> SALES HAS PRODUCTS
				 */
				$subTotal = 0;
				foreach ($request->getSession()->get('products') as $key => $productSave) {
					
					//SALES HAS PRODUCTS
					$product = $this->get('tianos.repository.product')->find($productSave['idItem']);
					
					$o = new SalesHasProducts();
					$o->setSales($entity);
					$o->setProduct($product);
					$o->setQuantity((float) $productSave['quantity']);
					$o->setUnitPrice($product->getPrice());
					$this->persist($o);
					
					
					//UPDATE POINTOFSALE HAS PRODUCT
					$pointofsaleHasProduct = $this->get('tianos.repository.pointofsale.has.product')->findByPdvAndProduct(
						$user->getPointOfSaleActiveId(),
						$productSave['idItem']
					);
					
					$pointofsaleHasProduct->setStock($pointofsaleHasProduct->getStock() - $productSave['quantity']);
					$this->persist($pointofsaleHasProduct);
					
					
					//SUM SUB TOTAL
					$subTotal += $product->getPrice() * $productSave['quantity'] * $salesQuantityPriceX;
				}
				
				
				/**
				 * PAYMENT HISTORY
				 */
				$total = $subTotal - $salesForm->discount;
				$changeBack = ($salesForm->payment > $total) ? $salesForm->payment - $total : 0;
				$paymentCollected = $salesForm->payment - $changeBack;
				$o = new PaymentHistory();
				$o->setSales($entity);
				$o->setSubTotal($subTotal);
				$o->setTotal($total);
				$o->setDiscount($salesForm->discount);
				$o->setPayment($salesForm->payment);
				$o->setChangeBack($changeBack);
				$o->setPaymentCollected($paymentCollected);
				$o->setReceivedDate(new \DateTime());
				$o->setPaymentType($this->get('tianos.repository.payment.type')->find($salesForm->paymentType));
				$this->persist($o);
				
				
				/**
				 * UPDATE OBJECT SALES
				 */
				$entity->setStatus(($paymentCollected >= $total) ? Sales::STATUS_CANCELED : Sales::STATUS_OPEN);
				$entity->setTotal($total);
				$this->persist($entity);
				
				
				/**
				 * REPORT PDV UPDATE
				 */
				foreach ($request->getSession()->get('products') as $key => $productSave) {
					
					$reportPdv = $this->get('tianos.repository.report.pdv')->findByHashAndProduct(
						$pdv->getPdvHash(),
						$productSave['idItem']
					);

					if (!$reportPdv) {
						continue;
					}
					
					$reportPdv->setStockSales($reportPdv->getStockSales() + $productSave['quantity']);
					$this->persist($reportPdv);
				}
				
				
				/**
				 * MESSAGE SUCCESS
				 */
				$this->flashAlertSuccess('Venta creada. CÓDIGO: <span class="label bg-green-active fontsize-12">' . $entity->getCode() . '</span>');
				
				
				
				/**
				 * REMOVE SESSION
				 */
				$request->getSession()->remove('products');
				
				
				/**
				 * Print Receipt
				 */
				$this->printReceipt();
				
				
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
				'salesQuantityPriceX' => $salesQuantityPriceX,
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
		if ($entity->getStatus() == Sales::STATUS_VOIDED) {
			return $this->render(
				"GridBundle::error.html.twig",
				[
					'message' => "La venta ha sido ANULADO anteriormente.",
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
		
		$salesHasProducts = $this->get('tianos.repository.sales.has.products')->findAllBySales($id);
		
		//SETTINGS SALES_UNIT
		$salesQuantityPriceX = $this->get('tianos.repository.settings')->findByClassName(Settings::SALES_QUANTITY_PRICE_X);
		
		return $this->render(
			$template,
			[
				'action' => $action,
				'entity' => $entity,
				'salesHasProducts' => $salesHasProducts,
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
				'TicketBundle:Sales/Grid/Box:table_client.html.twig',
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
		$request->getSession()->remove('products');
		
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
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		//$entity = $this->get($repository)->$method();
		
		
		//SETTINGS SALES_UNIT
		$salesQuantity = $this->get('tianos.repository.settings')->findByClassName(Settings::SALES_QUANTITY);
		$salesQuantityPriceX = $this->get('tianos.repository.settings')->findByClassName(Settings::SALES_QUANTITY_PRICE_X);
		
		if (!is_null($request->get('idItem'))) {
			//GUARDAR SESSION PRODUCTS
			$this->incrementDecrementSession($request, $request->get('action'), $salesQuantity);
		}
		
		//SET QUANTITY OF PRODUCT
		$productSession = [];
		foreach ($request->getSession()->get('products') as $key => $product) {
			$obj = $this->get('tianos.repository.product')->find($product['idItem']);
			$obj->setQuantity((float) $product['quantity']);
			$obj->setOutOfStock((bool) $product['out_of_stock']);
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
	private function incrementDecrementSession(Request $request, $action = Sales::INCREMENT, $salesQuantity)
	{
		
		$user = $this->getUser();
		
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
				
				if ($action == Sales::DECREMENT AND $product['quantity'] >= $salesQuantity) {
					$array[] = [
						'idItem' => $idItem,
						'quantity' => $product['quantity'] - $salesQuantity,
						'out_of_stock' => false
					];
				} else if ($action == Sales::INCREMENT) {
					
					//VALIDAR SI HAY QUANTITY DEL PRODUCT
					$pointofsaleHasProduct = $this->get('tianos.repository.pointofsale.has.product')->findByPdvAndProduct(
						$user->getPointOfSaleActiveId(),
						$idItem
					);
					
					if ($pointofsaleHasProduct->getStock() > $product['quantity']) {
						$array[] = [
							'idItem' => $idItem,
							'quantity' => $product['quantity'] + $salesQuantity,
							'out_of_stock' => false
						];
					} else {
						$array[] = [
							'idItem' => $idItem,
							'quantity' => $product['quantity'],
							'out_of_stock' => true
						];
					}

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
			
			//VALIDAR SI HAY QUANTITY DEL PRODUCT
			$pointofsaleHasProduct = $this->get('tianos.repository.pointofsale.has.product')->findByPdvAndProduct(
				$user->getPointOfSaleActiveId(),
				$idItem
			);
			
			if ($pointofsaleHasProduct->getStock() > 0) {
				$session->set('products', array_merge($products, [
					[
						'idItem' => $idItem,
						'quantity' => $salesQuantity,
						'out_of_stock' => false
					]
				]));
			}
			
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
		
		if (!empty($request->getSession()->get('products'))) {
			foreach ($request->getSession()->get('products') as $key => $product) {
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
	
	private function getSaleSubTotal(Request $request)
	{
		$subTotal = 0;
		
		//SETTINGS SALES_UNIT
		$salesQuantityPriceX = $this->get('tianos.repository.settings')->findByClassName(Settings::SALES_QUANTITY_PRICE_X);
		
		foreach ($request->getSession()->get('products') as $key => $productSave) {
			$product = $this->get('tianos.repository.product')->find($productSave['idItem']);
			$subTotal += $product->getPrice() * (float) $productSave['quantity'] * $salesQuantityPriceX;
		}
		
		return $subTotal;
	}
	
	private function printReceipt()
	{
//		$printer = $this->get('tianos.printer');
//		$printer->text("Hello World!\n");
//		$printer->cut();
//		$printer->close();
		
		$connector = new FilePrintConnector("localhost:631");
		$printer = new Printer($connector);
		
		$printer->text("Hello World - POLLAZO!\n");
		$printer->cut();
		
		$printer->close();
	}
	
	private function formValidation(Request $request, $groupName)
	{
		$salesForm = json_decode(json_encode($request->get($groupName)));
		
		if (empty($salesForm->client)) {
			throw new \Exception("Seleccione un cliente.");
		}
		
		if (empty($salesForm->paymentType)) {
			throw new \Exception("Seleccione un tipo de pago.");
		}
		
		if (empty($salesForm->deliveryDate)) {
			throw new \Exception("Seleccione la Fecha de entrega.");
		}
		
		if ($salesForm->payment < 0) {
			throw new \Exception("Ingrese pago del cliente.");
		}
		
		if (empty($request->getSession()->get('products'))) {
			throw new \Exception("Seleccione al menos un producto.");
		}
		
		if ($salesForm->discount > $this->getSaleSubTotal($request)) {
			throw new \Exception("El descuento no puede ser mayor al Importe Total.");
		}
	}
}
