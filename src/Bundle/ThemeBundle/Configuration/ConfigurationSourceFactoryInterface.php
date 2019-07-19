<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Configuration;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

interface ConfigurationSourceFactoryInterface
{
    /**
     * @param ArrayNodeDefinition $node
     */
    public function buildConfiguration(ArrayNodeDefinition $node): void;

    /**
     * @see ConfigurationProviderInterface
     *
     * @param ContainerBuilder $container
     * @param array $config
     *
     * @return Reference|Definition Configuration provider service
     */
    public function initializeSource(ContainerBuilder $container, array $config);

    /**
     * @return string
     */
    public function getName(): string;
}
