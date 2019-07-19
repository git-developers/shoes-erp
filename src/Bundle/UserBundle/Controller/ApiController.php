<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\CoreBundle\Controller\BaseController;
use Bundle\SessionBundle\Entity\Session;

class ApiController extends BaseController
{

    public function indexAction(Request $request): Response
    {
        return $this->json([
            'status' => self::STATUS_ERROR_API,
            'message' => 'mensaje',
        ]);
    }

    public function loginAction(Request $request): Response
    {

        $this->contentTypeValidation($request);

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);
//        $this->metadata = new Metadata('product', $applicationName, $parameters);

        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $vars = $configuration->getVars();

        //REPOSITORY
        $data = json_decode($request->getContent());
        $object = $this->get($repository)->$method($data);

        if(is_null($object)){
            return $this->json([
                'status' => self::STATUS_ERROR_API,
                'message' => 'The user name or password is incorrect (001)',
            ]);
        }

        $encoderService = $this->container->get('security.password_encoder');
        $match = $encoderService->isPasswordValid($object, $data->password);

        if(!$match){
            return $this->json([
                'status' => self::STATUS_ERROR_API,
                'message' => 'The user name or password is incorrect (002)',
            ]);
        }


        /**
         * SAVE SESSION - LOGIN END-USER
         */
//        $uuid = $this->get($repository)->uuid();
        $session = new Session();
        $session->setToken(uniqid("token-", true));
        $session->setUser($object);
        $this->persist($session);




        return $this->json([
            'status' => self::STATUS_SUCCESS_API,
            'message' => 'mensaje',
            'user' => $this->getSerializeDecode($object, $vars->serialize_group_name),
        ]);
    }

}
