<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ResourceBundleTest extends WebTestCase
{
    /**
     * @test
     */
    public function its_services_are_initializable()
    {
        /** @var ContainerInterface $container */
        $container = self::createClient()->getContainer();

        $services = $container->getServiceIds();

        $services = array_filter($services, function ($serviceId) {
            return 0 === strpos($serviceId, 'sylius.');
        });

        foreach ($services as $id) {
            $container->get($id);
        }
    }
}
