<?php

declare(strict_types=1);

namespace Bundle\GridBundle;

use Bundle\GridBundle\DependencyInjection\Compiler\RegisterDriversPass;
use Bundle\GridBundle\DependencyInjection\Compiler\RegisterFieldTypesPass;
use Bundle\GridBundle\DependencyInjection\Compiler\RegisterFiltersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class GridBundle extends Bundle
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
