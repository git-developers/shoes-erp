<?php

declare(strict_types=1);

namespace Bundle\GridBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class GridController extends BaseController
{

    /**
     * @var MetadataInterface
     */
    protected $metadata;

    /**
     * @var RequestConfigurationFactoryInterface
     */
    protected $requestConfigurationFactory;


//    public function __construct(RequestConfigurationFactoryInterface $requestConfigurationFactory) {
//        $this->requestConfigurationFactory = $requestConfigurationFactory;
//    }

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
        $rolesGranted = $configuration->getRolesGranted();
        
        //IS_GRANTED
	    $this->denyAccessUnlessGranted($rolesGranted, null, self::ACCESS_DENIED_MSG);

        //REPOSITORY
        $objects = $this->get($repository)->$method();
	    $objects = $this->rowImages($objects);
	    
        $varsRepository = $configuration->getRepositoryVars();
        $objects = $this->getSerialize($objects, $varsRepository->serialize_group_name);
	
//	    echo "POLLO:: <pre>";
//	    print_r($objects);
//	    exit;
        
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
	    $rolesGranted = $configuration->getRolesGranted();
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

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::STATUS_ERROR;

            try {

                if ($form->isValid()) {

                    $this->persist($entity);

                    $varsRepository = $configuration->getRepositoryVars();
	                $entity = $this->rowImage($entity);
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
    public function deleteAction(Request $request): Response
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
	    $rolesGranted = $configuration->getRolesGranted();
	
	    //IS_GRANTED
	    if (!$this->isGranted($rolesGranted)) {
		    return $this->render(
			    "GridBundle::error.html.twig",
			    [
				    'message' => self::ACCESS_DENIED_MSG,
			    ]
		    );
	    }
	    
        $errors = [];
        $status = self::STATUS_ERROR;
        $id = $request->get('id');

        if ($request->isMethod('DELETE')) {

            //REPOSITORY
            $repository = $configuration->getRepositoryService();
            $method = $configuration->getRepositoryMethod();
            $entity = $this->get($repository)->$method($id);

            try {
                if ($entity) {
	                $entity->setIsActive(false);
                    //$this->remove($entity);
                    $this->persist($entity);
                    $status = self::STATUS_SUCCESS;
                }
            }catch (\Exception $e){
                $errors[] = $e->getMessage();
            }

            return $this->json([
                'id' => $id,
                'status' => $status,
                'errors' => $errors,
            ]);
        }

        return $this->render(
            $template,
            [
                'id' => $id,
                'action' => $action,
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
	    $rolesGranted = $configuration->getRolesGranted();
	
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
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $entity = $this->get($repository)->$method($id);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        return $this->render(
            $template,
            [
                'action' => $action,
                'entity' => $entity,
            ]
        );
    }

    public function infoAction(Request $request): Response
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

        return $this->render(
            $template,
            [
                'action' => $action,
            ]
        );
    }
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function changePasswordAction(Request $request): Response
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
		$formType = $configuration->getFormType();
		$vars = $configuration->getVars();
		$entity = $configuration->getEntity();
		$entity = new $entity();
		
		//REPOSITORY
		$id = $request->get('id');
		$user = $this->get($repository)->$method($id);
		
		if (!$user) {
			throw $this->createNotFoundException('CRUD: Unable to find  entity.');
		}
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		if ($form->isSubmitted()) {
			
			$errors = [];
			$status = self::STATUS_ERROR;
			
			try{
				
				if ($form->isValid()) {
					
					$plainPassword = $entity->getNewPassword();
					$encoder = $this->get('security.encoder_factory')->getEncoder($user);
					$encodedPassword = $encoder->encodePassword($plainPassword, $user->getSalt());
					$user->setPassword($encodedPassword);
					
					$this->persist($user);
					
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

}


