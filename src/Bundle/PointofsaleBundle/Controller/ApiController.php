<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Controller;

use Mockery\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\CoreBundle\Controller\BaseController;

class ApiController extends BaseController
{

    public function indexAction(Request $request): Response
    {

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

        $data = json_decode($request->getContent());

        //REPOSITORY
        $object = $this->get($repository)->$method($data->username);

        $pointOfSales = [];

        if ($object) {
            foreach ($object->getRoute() as $key => $route) {
//                $pointOfSales[] = $route->getPointOfSale();

                foreach ($route->getPointOfSale() as $key => $pointOfSale) {
                    $pointOfSales[] = $pointOfSale;
                }
            }
        }

        $object = $this->getSerializeDecode($pointOfSales, $vars->serialize_group_name);

        return $this->json([
            'status' => self::STATUS_SUCCESS_API,
            'message' => 'mensaje',
            'point_of_sale' => $object,
        ]);
    }

}
