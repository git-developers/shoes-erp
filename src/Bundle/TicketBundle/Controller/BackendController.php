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
use Bundle\TicketBundle\Entity\TicketHasServices;

class BackendController extends GridController
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
		
		//REPOSITORY TREE
		$objectsTreeParent = $this->get('tianos.repository.category')->findAllParentsByType($user->getPointOfSaleActiveId(), Category::TYPE_SERVICE);
		$objectsTree = $this->getTreeEntities($objectsTreeParent, $configuration, 'tree');
		
		$servicesArray = [];
		$servicesObjs = $this->getServices($objectsTreeParent, $configuration, 'ticket', $servicesArray);
		//REPOSITORY TREE
		
		
		//SERVICES
		$serviceArray = [];
		$session = $request->getSession();
		$services = $session->get('services');
		
		if (!empty($services)) {
			foreach ($services as $key => $service) {
				$serviceObj = $this->get('tianos.repository.services')->find($service['idService']);
				$serviceObj->setQuantity($service['quantity']);
				$serviceArray[] = $this->getSerializeDecode($serviceObj, 'ticket');
			}
		}
		//SERVICES
		
		if ($form->isSubmitted()) {
			
			try {
				
				$ticket = $request->get('ticket');
				$ticket = json_decode(json_encode($ticket));
				
				$session = $request->getSession();
				$idClient = $session->get('id_client');
				$idEmployees = $session->get('id_employee');
				$services = $session->get('services');
				
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
				
				if (empty($services)) {
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
					$entity->addEmployee($employee);
				}
				
				$this->persist($entity);
				
				
				/**
				 * SAVE TICKET
				 */
				foreach ($services as $key => $service) {
					$service = $this->get('tianos.repository.services')->find($service['idService']);
					
					$ticketHasService = new TicketHasServices();
					$ticketHasService->setServices($service);
					$ticketHasService->setTicket($entity);
					$ticketHasService->setQuantity($service->getQuantity());
					$ticketHasService->setUnitPrice($service->getPrice());
					$ticketHasService->setSubTotal($service->getPrice() * $service->getQuantity());
					$this->persist($ticketHasService);
				}
				/**
				 * SAVE TICKET
				 */
				
				
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
				'objectsTree' => $objectsTree,
				'services' => $serviceArray
//				'form' => $form->createView(),
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
		$objectsTreeParent = $this->get('tianos.repository.category')->findAllParentsByType($user->getPointOfSaleActiveId(), Category::TYPE_SERVICE);
		$objectsTree = $this->getTreeEntities($objectsTreeParent, $configuration, 'tree');
		
		$servicesArray = [];
		$servicesObjs = $this->getServices($objectsTreeParent, $configuration, 'ticket', $servicesArray);
		//REPOSITORY TREE
		
		
		//SERVICES
		$serviceArray = [];
		$ticketHasServices = $this->get('tianos.repository.ticket.services')->findAllByService($id);
		foreach ($ticketHasServices as $key => $ths) {

			$services = $ths->getServices();
			$services->setQuantity($ths->getQuantity());
			$serviceArray[] = $this->getSerializeDecode($services, 'ticket');
		}
		//SERVICES
		
		
		if ($form->isSubmitted()) {
			
			try {
				
				$ticket = $request->get('ticket');
				$ticket = json_decode(json_encode($ticket));
				
				$session = $request->getSession();
				$idClient = $session->get('id_client');
				$idEmployees = $session->get('id_employee');
				$services = $session->get('services');
				
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
				
				if (empty($services)) {
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
				
				foreach ($services as $key => $service) {
					$service = $this->get('tianos.repository.services')->find($service['idService']);
					$entity->addServices($service);
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
				'objectsTree' => $objectsTree,
				'services' => $serviceArray,
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
		
		$ticketHasServices = $this->get('tianos.repository.ticket.services')->findAllByService($id);
		
		return $this->render(
			$template,
			[
				'action' => $action,
				'entity' => $entity,
				'ticketHasServices' => $ticketHasServices,
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
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		
		//USER
		$user = $this->getUser();
		
		$clients = $this->get('tianos.repository.user')->findAllClient($user->getPointOfSaleActiveId());
		$clients = is_object($clients) ? $clients->getUser() : [];
		$clients = $this->getSerializeDecode($clients, 'ticket');
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$client = $request->get('client');
			$client = (int) array_shift($client);
			
			$client = $this->get('tianos.repository.user')->findOneById($client);
			$client = $this->getSerializeDecode($client, 'ticket');
			
			
			
			/**
			 * ID CLIENT SESSION
			 */
			$session = $request->getSession();
//			$idClient = $session->get('id_client');
			$session->set('id_client', !is_null($client) ? $client['id'] : null);
			
//			if (is_null($idClient))
//			{
//				$session->set('id_client', $client['id']);
//			}
			/**
			 * ID CLIENT SESSION
			 */
			
			
			
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
	public function addEmployeeAction(Request $request): Response
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
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		//USER
		$user = $this->getUser();
		
		$employees = $this->get('tianos.repository.user')->findAllEmployee($user->getPointOfSaleActiveId());
		$employees = is_object($employees) ? $employees->getUser() : [];
		$employees = $this->getSerializeDecode($employees, 'ticket');
		
		if ($form->isSubmitted()) {
			
			$employees = $request->get('employee');
			
			$idEmployees = [];
			foreach ($employees as $key => $employee) {
				
				if (!is_array($employee)) {
					continue;
				}
				
				$idEmployees[] = (int) array_shift($employee);
			}
			
			$employees = $this->get('tianos.repository.user')->findAllByIds($idEmployees);
			$employees = $this->getSerializeDecode($employees, 'ticket');
			
			
			/**
			 * ID EMPLOYEE SESSION
			 */
			$session = $request->getSession();
			$out = [];
			$employees = is_array($employees) ? $employees : [];
			foreach ($employees as $key => $employee) {
				if (isset($employee['id'])) {
					$out[] = $employee['id'];
				}
			}
			$session->set('id_employee', $out);
			/**
			 * ID EMPLOYEE SESSION
			 */

//			$idEmployee = $session->get('id_employee');

//			if (is_null($idEmployee))
//			{
//				$out = [];
//				foreach ($employees as $key => $employee) {
//					$out[] = $employee['id'];
//				}
//
//				$session->set('id_employee', $out);
//			}
			
			return $this->render(
				'TicketBundle:BackendTicket/Grid/Box:table_employee.html.twig',
				[
					'status' => empty($employees) ? self::STATUS_ERROR : self::STATUS_SUCCESS,
					'employees' => $employees
				]
			);
		}
		
		return $this->render(
			$template,
			[
				'employees' => $employees,
				'action' => $action,
				'form' => $form->createView(),
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function incrementDecrementServicesAction(Request $request): Response
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
		
		$serviceArray = [];
		$session = $request->getSession();
		$action = $request->get('action');
		
		$this->incrementDecrementSession($request, $action);
		
		$services = $session->get('services');
		
		foreach ($services as $key => $service) {
			$serviceObj = $this->get('tianos.repository.services')->find($service['idService']);
			$serviceObj->setQuantity($service['quantity']);
			$serviceArray[] = $this->getSerializeDecode($serviceObj, 'ticket');
		}

		return $this->render(
			$template,
			[
				'services' => $serviceArray
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function removeAllServicesAction(Request $request): Response
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
//		$session->remove('id_client');
//		$session->remove('id_employee');
		$session->remove('services');
		
		return $this->render(
			$template,
			[
				'status' => self::STATUS_SUCCESS,
				'services' => []
			]
		);
	}
	
	private function getTreeEntities($parents, $configuration, $serializeGroupName)
	{
		if(is_null($parents)){
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
	
	private function getServices($parents, $configuration, $serializeGroupName, &$entity)
	{
		if(is_null($parents)){
			$parents = [];
		}
		
		foreach ($parents as $key => $parent) {
			
			$services = $this->get('tianos.repository.services')->findAllByCategory($parent);
			$result_1 = $this->getSerializeDecode($services, $serializeGroupName);
			
			$children = $this->get('tianos.repository.category')->findAllByParent($parent);
			$result_2 = $this->getServices($children, $configuration, $serializeGroupName, $entity);
			
			$entity = array_merge($result_1, $result_2);
		
		}

		return $entity;
	}
	
	private function incrementDecrementSession(Request $request, $action = self::INCREMENT)
	{
		
		//SESSION
		$idService = $request->get('idService');
		
		$session = $request->getSession();
		
		$services = $session->get('services');
		
		if (is_null($services))
		{
			$session->set('services', []);
		}
		
		$services = $session->get('services');
		
		$exist = false;
		foreach ($services as $key => $service) {
			
			if ($service['idService'] == $idService) {
				
				if ($action == self::DECREMENT AND $service['quantity'] >= 1) {
					$array[] = [
						'idService' => $idService,
						'quantity' => --$service['quantity']
					];
				}
				
				if ($action == self::INCREMENT) {
					$array[] = [
						'idService' => $idService,
						'quantity' => ++$service['quantity']
					];
				}
				
				unset($services[$key]);
				$session->set('services', array_merge($services, $array));
				
				$exist = true;
				break;
			}
		}
		
		$services = $session->get('services');
		
		// QUITAR CON ZEROS
		foreach ($services as $key => $service) {
			if ($service['quantity'] == 0) {
				unset($services[$key]);
				$session->set('services', $services);
			}
		}

		if (!$exist) {
			$session->set('services', array_merge($services, [
				[
					'idService' => $idService,
					'quantity' => 1,
				]
			]));
		}
	}
}
