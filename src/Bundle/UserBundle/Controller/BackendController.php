<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormError;


class BackendController extends GridController
{

    /**
     * @var MetadataInterface
     */
    protected $metadata;

    /**
     * @var RequestConfigurationFactoryInterface
     */
    protected $requestConfigurationFactory;
	
	
	/**
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function indexSuperAction(Request $request): Response
	{
//        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
		
		$parameters = [
			'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
		];
		$applicationName = $this->container->getParameter('application_name');
		$this->metadata = new Metadata('tianos', $applicationName, $parameters);
		
		//CONFIGURATION
		$configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
		$filesUpload = $configuration->getFilesUploadService();
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$template = $configuration->getTemplate('');
		$grid = $configuration->getGrid();
		$vars = $configuration->getVars();
		$modal = $configuration->getModal();
		
		//REPOSITORY
		$objects = $this->get($repository)->$method();
		$objects = $this->rowImages($objects);
		
		$varsRepository = $configuration->getRepositoryVars();
		$objects = $this->getSerialize($objects, $varsRepository->serialize_group_name);
		
		
//		echo "POLLO WWW:: <pre>";
//		print_r($objects);
//		exit;
		
		
		//GRID
		$gridService = $this->get('tianos.grid');
		$modal = $gridService->getModalMapper()->getDefaults($modal);
		$formMapper = $gridService->getFormMapper()->getDefaults();
		
		//DATATABLE
		$dataTable = $gridService->getDataTableMapper($grid)
			->setRoute()
			->setColumns()
			->setOptions()
			->setRowCallBack()
			->setData($objects)
			->setTableOptions()
			->setTableButton()
			->setTableHeaderButton()
			->setColumnsTargets()
			->resetGridVariable()
		;
		
		return $this->render(
			$template,
			[
				'vars' => $vars,
				'grid' => $grid,
				'modal' => $modal,
				'dataTable' => $dataTable,
				'form_mapper' => $formMapper,
				'filesUpload' => $filesUpload,
			]
		);
	}
 
	/**
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function indexAction(Request $request): Response
	{
//        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
		
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
		
		
		//USER
		$user = $this->getUser();
		
		
		//REPOSITORY
		$objects = $this->get($repository)->$method($user->getPointOfSaleActiveId());
		$objects = is_object($objects) ? $objects->getUser() : [];
		$varsRepository = $configuration->getRepositoryVars();
		$objects = $this->getSerialize($objects, $varsRepository->serialize_group_name);
		
		//GRID
		$gridService = $this->get('tianos.grid');
		$modal = $gridService->getModalMapper()->getDefaults($modal);
		$formMapper = $gridService->getFormMapper()->getDefaults();
		
		//DATATABLE
		$dataTable = $gridService->getDataTableMapper($grid)
			->setRoute()
			->setColumns()
			->setOptions()
			->setRowCallBack()
			->setData($objects)
			->setTableOptions()
			->setTableButton()
			->setTableHeaderButton()
			->setColumnsTargets()
			->resetGridVariable()
		;
		
		return $this->render(
			$template,
			[
				'vars' => $vars,
				'grid' => $grid,
				'modal' => $modal,
				'dataTable' => $dataTable,
				'form_mapper' => $formMapper,
			]
		);

//        return new JsonResponse([
//            'slug' => $this->get('sylius.generator.slug')->generate($name),
//        ]);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function createAction(Request $request): Response
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
		
		if ($form->isSubmitted()) {
			
			$errors = [];
			$entityJson = null;
			$status = self::STATUS_ERROR;
			
			if (!filter_var($entity->getEmail(), FILTER_VALIDATE_EMAIL)) {
				$form->get('email')->addError(new FormError("El email no es valido."));
			}
			
			try{
				
				if ($form->isValid()) {
					
					$this->persist($entity);
					
					//USER
					$user = $this->getUser();
					$pdv = $this->get('tianos.repository.pointofsale')->find($user->getPointOfSaleActiveId());
					
					if ($pdv) {
						$pdv->addUser($entity);
						$this->persist($pdv);
					}
					
					$varsRepository = $configuration->getRepositoryVars();
					$entity = $this->getSerializeDecode($entity, $varsRepository->serialize_group_name);
					$status = self::STATUS_SUCCESS;
				}else{
					foreach ($form->getErrors(true) as $key => $error) {
						if ($form->isRoot()) {
							$errors[] = $error->getMessage();
						} else {
							$errors[] = $error->getMessage();
						}
					}
				}
				
			}catch (\Exception $e){
				$errors[] = $e->getMessage();
			}
			
			return $this->json([
				'status' => $status,
				'errors' => $errors,
				'entity' => $entity,
			]);
		}
		
		return $this->render(
			$template,
			[
				'action' => $action,
				'form' => $form->createView(),
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function profileAction(Request $request): Response
	{
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }
		
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
		$vars = $configuration->getVars();
		
		$slug = $request->get('slug', null);
		
		$entity = $this->get($repository)->$method($slug);
		
		$isFriend = $this->get('tianos.repository.friends')->isFriend($entity->getUsername(), $this->getUser()->getId());
		$lastGoogleDriveFiles = $this->get('tianos.repository.google.drive')->lastFiles($this->getUser()->getId());
		
		if (!$entity) {
			throw $this->createNotFoundException('El usuario que busca no existe');
		}
		
		return $this->render(
			$template,
			[
				'vars' => $vars,
				'small_text' => '',
				'entity' => $entity,
				'isFriend' => $isFriend,
				'lastGoogleDriveFiles' => $lastGoogleDriveFiles,
			]
		);
	}

}
