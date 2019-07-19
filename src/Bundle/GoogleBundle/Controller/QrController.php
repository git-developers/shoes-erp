<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QrController extends BaseController {

    const MAX_AGE = 604800;

    public function qrAction(Request $request): Response
    {
        $link = $request->get('link', null);
        $qr = 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl='.$link.'&chld=L|0';

        $response = $this->render(
            'BackendBundle:Google:qr.html.twig',
            [
                'qr' => $qr,
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_WEEK);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }

}



