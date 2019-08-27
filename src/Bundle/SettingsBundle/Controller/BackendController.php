<?php

declare(strict_types=1);

namespace Bundle\SettingsBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BackendController extends GridController
{
	
	public function indexAction(Request $request): Response
	{
		$openingDate = new \DateTime("NOW");
		$openingDate = $openingDate->format('Y-m-d H:i:s');
		
		
		return new Response($openingDate);
	}


	
	
}
