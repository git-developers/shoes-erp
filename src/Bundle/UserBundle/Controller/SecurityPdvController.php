<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Webmozart\Assert\Assert;
use Bundle\UserBundle\Form\Type\PdvLoginType;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\CoreBundle\Vendor\Facebook\Facebook;

class SecurityPdvController extends BaseController
{
    /**
     * Login form action.
     */
    public function loginAction(Request $request, $slug): Response
    {

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');
		
        $slug = $request->get('slug');
        $pdv = $this->get('tianos.repository.pointofsale')->findBySlug($slug);

        if (!$pdv) {
            $this->flashError('Info: punto de venta no existe.');

            return $this->render("UserBundle:Security/Pdv:no_pdv.html.twig",
                [
                    'pdv' => null,
                ]
            );
        }

        $form = $this->createForm(PdvLoginType::class, null, [
            'pdv' => $pdv,
        ]);
        
        $form->handleRequest($request);

        return $this->render($template,
            [
                'form' => $form->createView(),
                'last_username' => $lastUsername,
                'error' => $error,
                'pdv' => $pdv,
            ]
        );
    }

    /**
     * Login check action. This action should never be called.
     */
    public function checkAction(Request $request): Response
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall.');
    }

    /**
     * Logout action. This action should never be called.
     */
    public function logoutAction(Request $request): Response
    {
        throw new \RuntimeException('You must configure the logout path to be handled by the firewall.');
    }

}
