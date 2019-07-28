<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\GridBundle\Controller\GridController;
use Bundle\ResourceBundle\ResourceBundle;
use Component\Resource\Metadata\Metadata;

class BackendMapController extends GridController
{
	
	/**
	 * @var MetadataInterface
	 */
	protected $metadata;
	
	/**
	 * @var RequestConfigurationFactoryInterface
	 */
	protected $requestConfigurationFactory;

    public function indexAction(Request $request): Response
    {
	    $parameters = [
		    'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
	    ];
	    $applicationName = $this->container->getParameter('application_name');
	    $this->metadata = new Metadata('tianos', $applicationName, $parameters);
	
	    //CONFIGURATION
	    $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
	    $template = $configuration->getTemplate('');
	    $action = $configuration->getAction();
	    $vars = $configuration->getVars();
	    $formType = $configuration->getFormType();
	    $entity = $configuration->getEntity();
	    $entity = new $entity();
	
	    //REPOSITORY
	    $id = $request->get('id');
	    $repository = $configuration->getRepositoryService();
	    $method = $configuration->getRepositoryMethod();
	    //$entity = $this->get($repository)->$method($id);
	    $entity = $this->get($repository)->$method();
	
	    //FORM
	    $form = $this->createForm($formType, $entity, [
		    'form_data' => []
	    ]);
	    $form->handleRequest($request);
	
	    if (!$entity) {
		    throw $this->createNotFoundException('CRUD: Unable to find  entity.');
	    }
	
	    if ($form->isSubmitted() && $form->isValid()) {
	    
	    }
	
	    return $this->render(
		    $template,
		    [
			    'vars' => $vars,
			    'entity' => $entity,
			    'form' => $form->createView(),
		    ]
	    );
    }
	
	public function infoAction(Request $request): Response
	{
		
		$parameters = [
			'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
		];
		$applicationName = $this->container->getParameter('application_name');
		$this->metadata = new Metadata('tianos', $applicationName, $parameters);
		
		//CONFIGURATION
		$configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
		$template = $configuration->getTemplate('');
		$action = $configuration->getAction();
		$vars = $configuration->getVars();
		
		//REPOSITORY
		$id = $request->get('id');
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$entity = $this->get($repository)->$method($id);
		
		return $this->render(
			$template,
			[
				'vars' => $vars,
				'entity' => $entity,
				//'form' => $form->createView(),
			]
		);
	}

}
