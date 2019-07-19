<?php

declare(strict_types=1);

namespace Bundle\OneToManyBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class OneToManyController extends BaseController
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
//        $repository = $configuration->getRepositoryService();

        $repositoryLeft = $configuration->getRepositoryServiceOne();
        $methodLeft = $configuration->getRepositoryMethodLeft();

        $repositoryRight = $configuration->getRepositoryServiceRight();
        $methodRight = $configuration->getRepositoryMethodRight();

        $template = $configuration->getTemplate('');

        $box = $configuration->oneToManyBox();
        $boxLeft = $configuration->oneToManyBoxLeft();
        $boxRight = $configuration->oneToManyBoxRight();
        $vars = $configuration->getVars();

        //REPOSITORY LEFT
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft();
        $varsLeft = $configuration->getRepositoryVarsLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $varsLeft->serialize_group_name);

        //REPOSITORY RIGHT
        $objectsRight = $this->get($repositoryRight)->$methodRight();
        $varsRight = $configuration->getRepositoryVarsRight();
        $objectsRight = $this->getSerializeDecode($objectsRight, $varsRight->serialize_group_name);

        //CRUD
        $crud = $this->get('tianos.one_to_many');
        $modal = $crud->getModalMapper()->getDefaults();
        $formMapper = $crud->getFormMapper()->getDefaults();



//        echo "POLLO:: <pre>";
//        print_r($objectsLeft);
//        exit;






        return $this->render(
            $template,
            [
                'box' => $box,
                'vars' => $vars,
                'modal' => $modal,
                'boxLeft' => $boxLeft,
                'boxRight' => $boxRight,
                'objectsLeft' => $objectsLeft,
                'objectsRight' => $objectsRight,
                'formMapper' => $formMapper,
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
    public function boxLeftSearchAction(Request $request)
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
        $boxLeft = $configuration->oneToManyBoxLeft();

        $repositoryLeft = $configuration->getRepositoryServiceOne();
        $methodLeft = $configuration->getRepositoryMethodLeft();

        $vars = $configuration->getVars();

        //REPOSITORY
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($request->get('q'));
        $varsLeft = $configuration->getRepositoryVarsLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $varsLeft->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxLeft' => $boxLeft,
                'objectsLeft' => $objectsLeft,
            ]
        );
    }

    public function boxRightSearchAction(Request $request)
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
        $boxRight = $configuration->oneToManyBoxRight();

        $repositoryLeft = $configuration->getRepositoryServiceOne();
        $methodLeft = $configuration->getRepositoryMethodLeft();
        $varsLeft = $configuration->getRepositoryVarsLeft();

        $repositoryRight = $configuration->getRepositoryServiceRight();
        $methodRight = $configuration->getRepositoryMethodRight();
        $varsRight = $configuration->getRepositoryVarsRight();

        //OneToMany Value
        $oneToManyLeftIds = $this->get($repositoryLeft)->$methodLeft($request->get('radioLeftValue'));
        $oneToManyLeftIds = $this->getSerializeDecode($oneToManyLeftIds, $varsLeft->serialize_group_name);

        //REPOSITORY
        $objectsRight = $this->get($repositoryRight)->$methodRight($request->get('q'));
        $objectsRight = $this->getSerializeDecode($objectsRight, $varsRight->serialize_group_name);


//        echo "POLLO:xxxxxx: <pre>";
//        print_r($oneToManyLeftIds);
//        exit;



        return $this->render(
            $template,
            [
                'boxRight' => $boxRight,
                'objectsRight' => $objectsRight,
                'oneToManyLeftIds' => $oneToManyLeftIds,
            ]
        );
    }

    public function boxRightSelectItemAction(Request $request): Response
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $boxLeftValue = $request->get('boxLeftValue');
        $boxRightValues = $request->get('boxRightValues');

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);

        $repositoryRight = $configuration->getRepositoryServiceRight();
        $methodRight = $configuration->getRepositoryMethodRight();

        $repositoryLeft = $configuration->getRepositoryServiceOne();
        $methodLeft = $configuration->getRepositoryMethodLeft();
        $methodDeleteAssociativeLeft = $configuration->getRepositoryMethodDeleteAssociativeLeft();
        $vars = $configuration->getVars();

        //DELETE
        $result = $this->get($repositoryLeft)->$methodDeleteAssociativeLeft($boxLeftValue);

        if ( !$result || empty($boxRightValues) ) {
            return $this->json([
                'status' => false,
                'response' => [
                    'message' => '',
                ],
            ]);
        }

        //SAVE
        $addEntity = $configuration->getAddEntityLeft();
        $removeEntity = $configuration->getRemoveEntityLeft();
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($boxLeftValue);

        foreach ($boxRightValues as $key => $boxRightValue){
            $objectsRight = $this->get($repositoryRight)->$methodRight($boxRightValue);
            $objectsLeft->$addEntity($objectsRight);
            $this->persist($objectsLeft);
        }
        //SAVE

        return $this->json([
            'status' => true,
            'response' => [
                'message' => '',
            ],
        ]);
    }

    public function boxLeftSelectItemAction(Request $request): Response
    {
        $id = $request->get('id');

        if (!$this->isXmlHttpRequest() || is_null($id)) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

//        $boxLeftValue = $request->get('boxLeftValue');
//        $boxRightValues = $request->get('boxRightValues');

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);

        $repositoryLeft = $configuration->getRepositoryServiceOne();
        $methodLeft = $configuration->getRepositoryMethodLeft();
        $template = $configuration->getTemplate('');
        $boxRight = $configuration->oneToManyBoxRight();
        $vars = $configuration->getVars();

        //REPOSITORY
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($id);
        $varsLeft = $configuration->getRepositoryVarsLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $varsLeft->serialize_group_name);


//        echo "POLLO:: <pre>";
//        print_r($objectsLeft);
//        exit;

        if ( !isset($objectsLeft[$boxRight->entity]) ) {
            throw $this->createNotFoundException('Tianos: validar el key "entity", este key se usa para enviar el array de objectos "objectsRight" ');
        }

        return $this->render(
            $template,
            [
                'boxRight' => $boxRight,
                'objectsRight' => $objectsLeft[$boxRight->entity],
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

