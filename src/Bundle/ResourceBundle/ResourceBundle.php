<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle;

use Bundle\ResourceBundle\DependencyInjection\Compiler\DoctrineTargetEntitiesResolverPass;
use Bundle\ResourceBundle\DependencyInjection\Compiler\RegisterFormBuilderPass;
use Bundle\ResourceBundle\DependencyInjection\Compiler\RegisterResourceRepositoryPass;
use Bundle\ResourceBundle\DependencyInjection\Compiler\RegisterResourcesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class ResourceBundle extends Bundle
{
    const DRIVER_DOCTRINE_ORM = 'doctrine/orm';
    const DRIVER_DOCTRINE_MONGODB_ODM = 'doctrine/mongodb-odm';
    const DRIVER_DOCTRINE_PHPCR_ODM = 'doctrine/phpcr-odm';

    /**
     * {@inheritdoc}
     */
//    public function build(ContainerBuilder $container): void
//    {
//        parent::build($container);
//
//        $container->addCompilerPass(new RegisterResourcesPass());
//        $container->addCompilerPass(new DoctrineTargetEntitiesResolverPass());
//        $container->addCompilerPass(new RegisterResourceRepositoryPass());
//        $container->addCompilerPass(new RegisterFormBuilderPass());
//    }

    /**
     * @return string[]
     */
    public static function getAvailableDrivers(): array
    {
        return [
            self::DRIVER_DOCTRINE_ORM,
            self::DRIVER_DOCTRINE_MONGODB_ODM,
            self::DRIVER_DOCTRINE_PHPCR_ODM,
        ];
    }
}
