<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\GoogleBundle\Entity\GoogleDriveFile;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class GoogleDriveFileController extends BaseController
{

    const STATUS_SUCCESS = 1;
    const STATUS_WARNING = 2;
    const STATUS_ERROR = 3;
    const STATUS_LOADING = 4;
    const STATUS_DELETE = 5;
    const STATUS_DUPLICATE_ENTRY = 1062;

    public function indexAction(Request $request): Response
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

//        $box = $vars->box;
        $boxOne = $vars->box_one;

        //REPOSITORY ONE
        $varsRepo = $configuration->getRepositoryVars();
        $objectsOne = $this->get($boxOne->repository->service)->{$boxOne->repository->method}();
        $objectsOne = $this->getSerializeDecode($objectsOne, $boxOne->repository->vars->serialize_group_name);



//        echo "POLLO:: <pre>";
//        print_r($objectsOne);
//        exit;



        /**
         * OLD
         */
        $field = $request->get('field');
        $parents = $request->get('parents');
        $folderName = $request->get('folder_name');
        $search = $request->get('search');
        $pageToken = $request->get('page', null);

        $google = $this->get('tianos.service.google.drive.service');
        $authUrl = $google->getAuthUrl();

        if(!$authUrl['status']){
            return $this->redirect($this->generateUrl('backend_google_drive_account_permissions'));
        }

        $results = $google->getGoogleFiles($field, $parents, $search, $pageToken);
        $files = $results->getFiles();
        $smallText = $google->createSmallText($field);
        /**
         * OLD
         */




        /*
        //**************************
        $google->redisDelete('pollo');
        $files = $google->redisGet('pollo');

        if(empty($files)){
            $files = $google->redisSet('pollo', $results->getFiles());
        }
        //**************************
        */

        return $this->render(
            $template,
            [
                'vars' => $vars,
                'field' => $field,
                'parents' => $parents,
                'files' => $files,
                'folder_name' => $folderName,
                'search' => $search,
                'small_text' => $smallText,
                'next_page_token' => $results->nextPageToken,
                'objectsOne' => $objectsOne,
            ]
        );
    }

    public function accountPermissionsAction(Request $request): Response
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



        /**
         * OLD
         */
        $authCode = $request->get('code');

        $google = $this->get('tianos.service.google.drive.service');
        $authUrl = $google->getAuthUrl();

        if ($authUrl['status']) {
            return $this->redirect($this->generateUrl('backend_google_drive_index', ['id' => 'my-drive']));
        }

        if (isset($authCode)) {

            $result = $google->storeCredentials($authCode);

            if(!$result){
                $this->flashWarning('Oops! parece que no se termino el proceso, reintente.');
                return $this->redirect($this->generateUrl('backend_google_drive_account_permissions'));
            }

//            return $this->redirect($this->generateUrl('backend_google_drive_index', ['id' => 'my-drive']));
        }
        /**
         * OLD
         */

        return $this->render(
            $template,
            [
                'vars' => $vars,
                'auth_url' => $authUrl['auth_url'],
            ]
        );
    }

    public function revokeTokenAction(Request $request): Response
    {
        $google = $this->get('tianos.service.google.drive.service');
        $google->revokeToken();

        return $this->redirect($this->generateUrl('backend_google_drive_account_permissions'));
    }

    public function breadcrumbAction($files): Response
    {

        $file = array_shift($files);
        $name = isset($file['name']) ? $file['name'] : '(no disponible)';
        $parents = isset($file['parents']) ? $file['parents'] : [];
        $parents = array_shift($parents);

        /*
        $bread = explode('/', $path);
        $crumbtrail = '';
        foreach ($bread as $crumb) {
            list($id, $name) = $this->explode_node_path($crumb);
            $name = empty($name) ? $id : $name;
            $breadcrumb[] = array(
                'name' => $name,
                'path' => $this->build_node_path($id, $name, $crumbtrail)
            );
            $tmp = end($breadcrumb);
            $crumbtrail = $tmp['path'];
        }
        return $breadcrumb;
        */

        return $this->render(
            'BackendBundle:Googledrive:breadcrumb.html.twig',
            [
                'parents' => $parents,
                'name' => $name,
            ]
        );
    }

    public function saveAction(Request $request): Response
    {

//        $pusher = $this->container->get('gos_web_socket.zmq.pusher');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $response = new \stdClass();

        $files = $request->get('files', []);

        if(empty($files)){
            return new Response(0);
        }

        foreach ($files as $key => $file){

            $file = isset($file['file']) ? $file['file'] : '';
            $file = json_decode(base64_decode($file));

            $fileId = isset($file[0]) ? $file[0] : '';
            $fileName = isset($file[1]) ? $file[1] : '';
            $fileIconLink = isset($file[2]) ? $file[2] : '';
            $fileMimeType = isset($file[3]) ? $file[3] : '';
            $fileSize = isset($file[4]) ? $file[4] : '';

            $response->id = $fileId;
            $response->status = self::STATUS_LOADING;
            $response->message = 'loading';
//            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

//            sleep(1);

            try {

                $entity = $this->get('tianos.repository.google.drive')->findOneByFileId($fileId);

                if (is_null($entity)) {
                    $entity = new GoogleDriveFile;
                    $response->message = 'Se agrego el archivo';
                } else {
                    $entity->setIsActive(true);
                    $response->message = 'Se actualizo el archivo';
                }

                $entity->setUniqueId(uniqid());
                $entity->setFileId($fileId);
                $entity->setFileName($fileName);
                $entity->setFileNameOriginal($fileName);
                $entity->setFileSize($fileSize);
                $entity->setFileIconLink($fileIconLink);
                $entity->setFileMimeType($fileMimeType);
                $entity->setFileMimeTypeShort($fileMimeType);
                $entity->setUser($user);
                $this->persist($entity);

                sleep(1);

                //user
//                $user->removeFile($entity);
//                $user->addFile($entity);
//                $this->save($user);

                $response->id = $fileId;
                $response->status = self::STATUS_SUCCESS;

            } catch(UniqueConstraintViolationException $e) {
                $response->id = $fileId;
                $response->status = self::STATUS_DUPLICATE_ENTRY;
                $response->message = 'El archivo ya fue incluido anteriormente.';
            }

//            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

        }

        return new Response(1);

    }

    /*
    public function deleteOneAction(Request $request)
    {

        $response = new \stdClass();
        $response->status = "fail";

//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_PROFILE')) {
//            $response->status = "access-denied";
//            $responseJson = json_encode($response);
//            return new Response($responseJson);
//        }

        $uniqueId = $request->get('id', null);
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoreBundle:Files')->findOneByUniqueId($uniqueId);

        if($entity){
            try {
                $entity->setIsActive(0);
                $this->save($entity);
                $response->status = "ok";
            }catch (\Exception $e){

            }
        }

        return $this->json($response);
    }

    public function deleteManyAction(Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $response = new \stdClass();
        $pusher = $this->container->get('gos_web_socket.zmq.pusher');
        $files = $request->get('files', []);

        if(empty($files)){
            return new Response(0);
        }


        foreach ($files as $key => $file){

            $file = isset($file['file']) ? $file['file'] : '';
            $file = json_decode(base64_decode($file));

            $idFile = isset($file[0]) ? $file[0] : '';

            $response->id = $idFile;
            $response->status = self::STATUS_LOADING;
            $response->message = 'loading';
            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

            // sleep for 2 seconds
            sleep(2);

            try {
                $fileEntity = $em->getRepository('CoreBundle:Files')->findOneByIdFile($idFile);

                if($fileEntity){
                    $fileEntity->setIsActive(0);
                    $this->save($fileEntity);
                }

                $response->id = $idFile;
                $response->status = self::STATUS_DELETE;
                $response->message = 'Se elimino el archivo';

            } catch(\Exception $e) {
                $response->id = $idFile;
                $response->status = self::STATUS_ERROR;
                $response->message = 'Ocurrio una excepcion, reintentar.';
            }

            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

        }

        return new Response(1);

    }

    */

}
