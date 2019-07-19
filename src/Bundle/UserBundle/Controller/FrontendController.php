<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bundle\UserBundle\Entity\Friends;

class FrontendController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        return $this->redirectUrl('frontend_default_index', 365);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addFriendAction($username, Request $request): Response
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

        $friend = $this->getUser();

        $entity = $this->get($repository)->$method($username, $friend->getId());

        if (!$entity) {

            $user = $this->get('tianos.repository.user')->findOneByUsername($username);

            $friends = new Friends();
            $friends->setUser($user);
            $friends->setFriend($friend);
            $this->persist($friends);
        }

        return $this->json([
           'status' => true
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function removeFriendAction($username, Request $request): Response
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

        $friend = $this->getUser();

        $entity = $this->get($repository)->$method($username, $friend->getId());

        if ($entity) {
            $this->remove($entity);
        }

        return $this->json([
            'status' => true
        ]);
    }

}
