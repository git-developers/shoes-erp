<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\GoogleBundle\Entity\GoogleDriveFile;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class GoogleDriveFileGridController extends GridController
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

        $q = $request->get('q', null);

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
//        $objects = $this->get($repository)->$method();
//        $varsRepository = $configuration->getRepositoryVars();
//        $objects = $this->getSerialize($objects, $varsRepository->serialize_group_name);

        $objects = getcwd() . '/google-drive-files/google-drive-files.json';
        $objects = file_get_contents($objects);

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
                'q' => $q,
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
     *
     * @return Response
     */
    public function misArchivosAction(Request $request): Response
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
        $objects = $this->get($repository)->$method($this->getUser()->getId());
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


//        echo "POLLO:: <pre>";
//        print_r($objects);
//        exit;

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
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function relevanceAction(Request $request): Response
    {
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $id = $request->get('id', null);
        $fileName = $request->get('fileName', null);
        $fileName = base64_decode($fileName);

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

        $objects = $this->get($repository)->$method($id, $fileName);

        return $this->render(
            $template,
            [
                'objects' => $objects,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function watchAction(Request $request): Response
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

        if (!$entity) {
            throw $this->createNotFoundException('el archivo que busca no existe');
        }

        //INSERT VIEW
        $this->get('tianos.repository.google.drive.count')->insertView($entity->getId());

        return $this->render(
            $template,
            [
                'vars' => $vars,
                'small_text' => '',
                'entity' => $entity,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function qrAction(Request $request): Response
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
        $vars = $configuration->getVars();

        $qr = 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=' . $request->get('link', null) . '&chld=L|0';

        return $this->render(
            $template,
            [
                'qr' => $qr,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function shareCountAction(Request $request): Response
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
//        $template = $configuration->getTemplate('');
//        $vars = $configuration->getVars();

        $fileId = $request->get('fileId', null);

        $this->get($repository)->$method($fileId);

        return $this->json(
            [
                'status' => true,
            ]
        );
    }

}
