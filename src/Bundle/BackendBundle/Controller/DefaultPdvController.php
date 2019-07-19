<?php

declare(strict_types=1);

namespace Bundle\BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class DefaultPdvController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
//        return $this->redirectUrl('frontend_default_index');


        $user = $this->getUser();
	
//	    echo "POLLO:::USERNAME:::: <pre>";
//	    print_r( $user->getPointOfSaleActive()->getName() );
//	    exit;


//	    $token = $this->container->get('security.token_storage')->getToken();
//	    $user = $token->getUser();
        
//	    echo "POLLO:: <pre>";
//	    print_r($user->getPointOfSaleActive()->getName());
//	    exit;



//        echo 'PDV DefaultController --- GATO:::<pre>';
//        print_r($user->getRoles());
//        exit;


//        $pointOfSales = $this->getUser()->getPointOfSale();
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
