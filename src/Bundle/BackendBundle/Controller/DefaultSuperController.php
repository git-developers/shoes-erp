<?php

declare(strict_types=1);

namespace Bundle\BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class DefaultSuperController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
//        return $this->redirectUrl('frontend_default_index');


//        $user = $this->getUser();
//        echo 'SUPER DefaultController --- GATO:::<pre>';
//        print_r($user->getRoles());
//        exit;


//        $pointOfSales = $this->getUser()->getPointOfSale();
//
//
//        foreach ($pointOfSales as $key => $pointOfSale) {
//
//            echo "<pre>";
//            print_r($pointOfSale->getName());
//
//        }
//
//        exit;

        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        return $this->render($template, [
            'form' => null
        ]);
    }

}
