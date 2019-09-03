<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class BackendAddUserController extends GridController
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

        //REPOSITORY
	    $varsRepository = $configuration->getRepositoryVars();
        $objectsPDV = $this->get($repository)->$method($request->get('id'));
	
	    $objects = [];
	    $users = is_object($objectsPDV) ? $objectsPDV->getUser() : [];
	    foreach ($users as $key => $user) {
		    $objects[] = $this->getSerializeDecode($user, $varsRepository->serialize_group_name);
	    }
	
	    $objects = json_encode($objects);
		//REPOSITORY

	
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
	
	    $session = $request->getSession();
	    $session->set('id_pointofsale', $request->get('id'));
	    $pdv = $this->get('tianos.repository.pointofsale')->find($request->get('id'));

        return $this->render(
            $template,
            [
                'pdv' => $pdv,
                'vars' => $vars,
                'grid' => $grid,
                'modal' => $modal,
                'dataTable' => $dataTable,
                'form_mapper' => $formMapper,
            ]
        );
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
	
	    $pdvParent = $this->get('tianos.repository.pointofsale')->find($request->get('idParent'));

        $form = $this->createForm($formType, $entity, [
            'form_data' => [
                'pdv_parent' => $pdvParent,
            ],
        ]);
        
        $form->handleRequest($request);
	
	    if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::STATUS_ERROR;

            try{

                if ($form->isValid()) {
                	
	                $pdv = $this->get('tianos.repository.pointofsale')->find($request->getSession()->get('id_pointofsale'));
	                
	                
	                //SAVE USER
	                $entity->setPointOfSaleActive($pdv);
	                $this->persist($entity);
	
	                
	                //ADD USER TO PDV
	                $pdv->addUser($entity);
	                $this->persist($pdv);
	                

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


}
