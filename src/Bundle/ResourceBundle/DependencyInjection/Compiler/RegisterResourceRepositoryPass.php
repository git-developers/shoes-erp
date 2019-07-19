<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class RegisterResourceRepositoryPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasParameter('sylius.resources') || !$container->has('sylius.registry.resource_repository')) {
            return;
        }

        $resources = $container->getParameter('sylius.resources');

        $repositoryRegistry = $container->findDefinition('sylius.registry.resource_repository');

        foreach ($resources as $alias => $configuration) {
            [$applicationName, $resourceName] = explode('.', $alias, 2);
            $repositoryId = sprintf('%s.repository.%s', $applicationName, $resourceName);

            if ($container->has($repositoryId)) {
                $repositoryRegistry->addMethodCall('register', [$alias, new Reference($repositoryId)]);
            }
        }
    }
}
