<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Controller;

use JMS\Serializer\SerializationContext;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Bundle\PointofsaleBundle\Entity\PointOfSaleHasProduct;

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
	
	    $pdvId = $request->get('pdvId');
	    $categoryId = $request->get('categoryId');
	    
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
        $tree = $configuration->getTree();
        $modal = $configuration->getModal();

        //REPOSITORY
        $objects = $this->get($repository)->$method($pdvId, $categoryId);
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
	    

        //REPOSITORY TREE
        //$objectsTree = $this->get('tianos.repository.category')->findAllParentsByType($user->getPointOfSaleActiveId(), $varsRepository->entity_type);
        $objectsTree = $this->get('tianos.repository.category')->findAllParentsByType($varsRepository->entity_type);
        $objectsTree = $this->getTreeEntities($objectsTree, $configuration, 'tree');
	
	    $pointOfSales = $this->get('tianos.repository.pointofsale')->findAll();
        
        return $this->render(
            $template,
            [
                'vars' => $vars,
                'tree' => $tree,
                'grid' => $grid,
                'modal' => $modal,
                'pointOfSales' => $pointOfSales,
                'objectsTree' => $objectsTree,
                'dataTable' => $dataTable,
                'form_mapper' => $formMapper,
                'pdvId' => $pdvId,
                'categoryId' => $categoryId,
            ]
        );
    }

    private function getTreeEntities($parents, $configuration, $serializeGroupName)
    {
        if(is_null($parents)){
            $parents = [];
        }

        $entity = [];
        foreach ($parents as $key => $parent){
            $entity[$key]['parent'] = $this->getSerializeDecode($parent, $serializeGroupName);
            $children = $this->get('tianos.repository.category')->findAllByParent($parent);
            $entity[$key]['children'] = $this->getTreeEntities($children, $configuration, $serializeGroupName);
        }

        return $entity;
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

        $categoryId = $request->get('category_id');

        $form = $this->createForm($formType, $entity, [
            'form_data' => [
                'category_id' => $categoryId
            ]
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::STATUS_ERROR;

            try{

                if ($form->isValid()) {
	
	                $this->persist($entity);
	
	                /**
	                 * SAVE producto TO pdv
	                 */
                    $pointOfSales = is_array($request->get('product')) ? $request->get('product')['pointOfSale'] : [];

                    foreach ($pointOfSales as $key => $pointOfSale) {
	                    $pdv = $this->get('tianos.repository.pointofsale')->find($pointOfSale);
	                    
	                    $pdvHasProduct = new PointOfSaleHasProduct();
	                    $pdvHasProduct->setPointOfSale($pdv);
	                    $pdvHasProduct->setPointOfSale($pdv);
	                    $this->persist($pdvHasProduct);
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
		$rolesAllow = $configuration->getRolesAllow();
		$formType = $configuration->getFormType();
		$vars = $configuration->getVars();
		
		//IS_GRANTED
		if (!$this->isGranted($rolesAllow)) {
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
					
					/**
					 * SAVE producto TO pdv
					 */
//					$this->get('tianos.repository.product')->deleteAssociativeTableById($entity->getId());
//					$pointOfSales = is_array($request->get('product')) ? $request->get('product')['pointOfSale'] : [];
//
//					foreach ($pointOfSales as $key => $pointOfSale) {
//						$pdv = $this->get('tianos.repository.pointofsale')->find($pointOfSale);
//						$pdv->addProduct($entity);
//						$this->persist($pdv);
//					}
					
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
