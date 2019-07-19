<?php

declare(strict_types=1);

namespace Bundle\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class DefaultController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        $vars = $options['vars'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        $googleDriveFiles = $this->get('tianos.repository.google.drive')->findAllHasThumbnail();

        return $this->render($template, [
            'googleDriveFiles' => $googleDriveFiles,
            'vars' => $vars,
        ]);

//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function contactUsFacebookAction(Request $request): Response
    {
        header('Location: https://www.facebook.com/Apptianos');
        die();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function contactUsTwitterAction(Request $request): Response
    {
        header('Location: https://twitter.com/tianosApp');
        die();
    }
}
