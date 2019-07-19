<?php

declare(strict_types=1);

namespace Bundle\TreeOneToManyBundle;

use Bundle\TreeOneToManyBundle\DependencyInjection\Compiler\RegisterDriversPass;
use Bundle\TreeOneToManyBundle\DependencyInjection\Compiler\RegisterFieldTypesPass;
use Bundle\TreeOneToManyBundle\DependencyInjection\Compiler\RegisterFiltersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class TreeOneToManyBundle extends Bundle
{
    const DRIVER_DOCTRINE_ORM = 'doctrine/orm';
    const DRIVER_DOCTRINE_PHPCR_ODM = 'doctrine/phpcr-odm';

//    /**
//     * {@inheritdoc}
//     */
//    public function build(ContainerBuilder $container)
//    {
//        parent::build($container);
//
////        $container->addCompilerPass(new RegisterDriversPass());
////        $container->addCompilerPass(new RegisterFiltersPass());
////        $container->addCompilerPass(new RegisterFieldTypesPass());
//    }

    /**
     * @return string[]
     */
    public static function getAvailableDrivers()
    {
        return [
            self::DRIVER_DOCTRINE_ORM,
            self::DRIVER_DOCTRINE_PHPCR_ODM,
        ];
    }
}
