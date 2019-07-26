<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\UserBundle\Entity\ChangePassword;

class BackendSettingController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
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
        $grid = $configuration->getGrid();
        $vars = $configuration->getVars();

        $box = $vars->box;
        $boxLeft = $vars->box_left;
        $boxCenter = $vars->box_center;
        $boxRight = $vars->box_right;

        $active = $request->get('active', null);

        $user = $this->getUser();
//        $user = $this->get($repository)->$method($user->getId());

        if (!$user) {
            throw $this->createNotFoundException('el archivo que busca no existe');
        }


        $formEdit = $this->createForm($boxLeft->form->type, $user,  [
//            'action' => $this->generateUrl('backend_user_setting_index'),
//            'method' => 'POST',
            'attr' => ['class' => '']
        ]);

        $formAvatar = $this->createForm($boxCenter->form->type, $user,  [
            'attr' => ['class' => ''],
        ]);

        $formPassword = $this->createForm($boxRight->form->type, new ChangePassword,  [
            'attr' => ['class' => '']
        ]);

        if('POST' === $request->getMethod()) {

            if ($request->request->has('user_edit')) {

                $active = 2;
                $formEdit->handleRequest($request);

//                $image = $user->getImage();
//
//                if(is_null($image)){
//                    $entity->setImage(new File('bundles/core/common/images/no_avatar.jpg'));
//                }

                if ($formEdit->isSubmitted() && $formEdit->isValid()) {

//                    if(is_null($image)){
//                        $entity->setImage(null);
//                    }

                    $this->persist($user);
                    $this->flashSuccess('Cambios guardados');

                    return $this->redirectToRoute('backend_user_setting_index', ['active' => 2]);
                }
            }

            if ($request->request->has('user_avatar')) {

                $active = 1;
                $fileName = $user->getAvatarFileName();
                $username = $user->getUsername();
                $formAvatar->handleRequest($request);

                if ($formAvatar->isSubmitted() && $formAvatar->isValid()) {

                    $file = $user->getImage();

                    //remove avatar
                    $this->get('backend.file_uploader')->removeAvatar($fileName);

                    //upload avatar
                    $fileName = $this->get('backend.file_uploader')->uploadAvatar('user', $username, $file);
                    $user->setImage($fileName);

                    $this->persist($user);
                    $this->flashSuccess('Cambios guardados');

                    return $this->redirectToRoute('backend_user_setting_index', ['active' => 1]);
                }
            }

            if ($request->request->has('user_password')) {

                $active = 3;
                $formPassword->handleRequest($request);

                if ($formPassword->isSubmitted() && $formPassword->isValid()) {

                    $password = $formPassword->get('newPassword')->getData();
                    $password = $this->get('security.password_encoder')->encodePassword($user, $password);
                    $user->setPassword($password);

                    $this->persist($user);
                    $this->flashSuccess('Cambios guardados');

                    return $this->redirectToRoute('backend_user_setting_index', ['active' => 3]);
                }
            }

        }

        return $this->render(
            $template,
            [
                'boxLeft' => $boxLeft,
                'boxCenter' => $boxCenter,
                'boxRight' => $boxRight,
                'formEdit' => $formEdit->createView(),
                'formAvatar' => $formAvatar->createView(),
                'formPassword' => $formPassword->createView(),
                'active' => ( is_numeric($active) && ($active >= 1 && $active <=3) ) ? $active : 1,
            ]
        );
    }

}
