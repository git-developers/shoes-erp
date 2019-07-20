<?php

declare(strict_types=1);

namespace Bundle\TreeBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\CategoryBundle\Entity\Category;

class TreeController extends BaseController
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
        $tree = $configuration->getTree();
        $vars = $configuration->getVars();

        //CATEGORY TYPE
        $entityType = $request->get('entity_type');

        if (!Category::isEntityType($entityType)) {
            throw $this->createNotFoundException('TREE TYPE: Unable to find category type.');
        }
	
	    //USER
	    $user = $this->getUser();

        
        //REPOSITORY
	    //AQUI SE BUSCABA LAS CATEGORIAS FILTRADA POR PDV
	    //$objects = $this->get($repository)->$method($user->getPointOfSaleActiveId(), $entityType);
	    $objects = $this->get($repository)->$method($entityType);
        $varsRepository = $configuration->getRepositoryVars();
        $objects = $this->getTreeEntities($objects, $configuration, $varsRepository->serialize_group_name);
        
        
        //CRUD
        $crud = $this->get('tianos.tree');
        $modal = $crud->getModalMapper()->getDefaults();
        $formMapper = $crud->getFormMapper()->getDefaults();

        return $this->render(
            $template,
            [
                'vars' => $vars,
                'tree' => $tree,
                'modal' => $modal,
                'objects' => $objects,
                'entityType' => $entityType,
                'form_mapper' => $formMapper,
            ]
        );

//        return new JsonResponse([
//            'slug' => $this->get('sylius.generator.slug')->generate($name),
//        ]);
    }

    private function getTreeEntities($parents, $configuration, $serializeGroupName)
    {
        if(is_null($parents)){
            $parents = [];
        }

        $repository = $configuration->getRepositoryService();
//        $method = $configuration->getRepositoryMethod();

        $entity = [];
        foreach ($parents as $key => $parent){
            $entity[$key]['parent'] = $this->getSerializeDecode($parent, $serializeGroupName);
            $children = $this->get($repository)->findAllByParent($parent);
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


        //CATEGORY TYPE
        $entityType = $request->get('entity_type');

        if ($request->isMethod('POST')) {
            $entityType = $request->get('category');
            $entityType = $entityType['type'];
        }

        if (!Category::isEntityType($entityType)) {
            throw $this->createNotFoundException('TREE TYPE: Unable to find category type.');
        }

        //FORM
        $form = $this->createForm($formType, $entity, [
            'form_data' => [
                'entity_type' => $entityType
            ]
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::STATUS_ERROR;

            try {

                if ($form->isValid()) {
                	
                    $this->persist($entity);
	
	                //USER
	                $user = $this->getUser();
	                $pdv = $this->get('tianos.repository.pointofsale')->find($user->getPointOfSaleActiveId());

	                if ($pdv) {
		                $pdv->addCategory($entity);
		                $this->persist($pdv);
	                }
                    
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
    public function createChildAction(Request $request): Response
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

        //ENTITY
        $entity = $configuration->getEntity();
        $entity = new $entity();


        //CATEGORY TYPE
        $entityType = $request->get('entity_type');

        if ($request->isMethod('POST')) {
            $entityType = $request->get('category');
            $entityType = $entityType['type'];
        }

        if (!Category::isEntityType($entityType)) {
            throw $this->createNotFoundException('TREE TYPE: Unable to find category type.');
        }


        //FORM
        $id = $request->get('id');
        $form = $this->createForm($formType, $entity, [
            'form_data' => [
                'entity_type' => $entityType,
                'parent_id' => $id
            ]
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::STATUS_ERROR;

//            try {

                if ($form->isValid()) {
                    $this->persist($entity);
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

//            } catch (\Exception $e){
//                $errors[] = $e->getMessage();
//            }

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
        $formType = $configuration->getFormType();
        $vars = $configuration->getVars();
        $varsRepository = $configuration->getRepositoryVars();

        //REPOSITORY
        $id = $request->get('id');
        $entity = $this->get($repository)->$method($id);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        $form = $this->createForm($formType, $entity, ['form_data' => []]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $status = self::STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
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

        $errors = [];
        $status = self::STATUS_ERROR;
        $id = $request->get('id');

        if ($request->isMethod('DELETE')) {

            //REPOSITORY
            $repository = $configuration->getRepositoryService();
            $method = $configuration->getRepositoryMethod();
            $entity = $this->get($repository)->$method($id);

            try {
                if($entity){
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

}


/*
Component\Resource\Metadata\Metadata Object
(
[name:Component\Resource\Metadata\Metadata:private] => product
[applicationName:Component\Resource\Metadata\Metadata:private] => sylius
[driver:Component\Resource\Metadata\Metadata:private] => doctrine/orm
[templatesNamespace:Component\Resource\Metadata\Metadata:private] =>
[parameters:Component\Resource\Metadata\Metadata:private] => Array
(
    [driver] => doctrine/orm
    [classes] => Array
        (
            [model] => Component\Core\Model\CRUD_DUMMY
            [repository] => Bundle\CoreBundle\Doctrine\ORM\CRUD_DUMMYRepository
            [interface] => Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface
            [controller] => Bundle\ResourceBundle\Controller\ResourceController
            [factory] => Component\Resource\Factory\TranslatableFactory
            [form] => Bundle\CRUDDUMMYBundle\Form\Type\CRUD_DUMMYType
        )

    [translation] => Array
        (
            [classes] => Array
                (
                    [model] => Component\Core\Model\CRUD_DUMMYTranslation
                    [interface] => Component\CRUD_DUMMY\Model\CRUD_DUMMYTranslationInterface
                    [controller] => Bundle\ResourceBundle\Controller\ResourceController
                    [factory] => Component\Resource\Factory\Factory
                    [form] => Bundle\CRUDDUMMYBundle\Form\Type\CRUD_DUMMYTranslationType
                )

        )

)

)
 */
