<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Configuration\Filesystem;

use Bundle\ThemeBundle\Configuration\ConfigurationSourceFactoryInterface;
use Bundle\ThemeBundle\Locator\RecursiveFileLocator;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class FilesystemConfigurationSourceFactory implements ConfigurationSourceFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildConfiguration(ArrayNodeDefinition $node): void
    {
        $node
            ->fixXmlConfig('directory', 'directories')
                ->children()
                    ->scalarNode('filename')->defaultValue('composer.json')->cannotBeEmpty()->end()
                    ->arrayNode('directories')
                        ->defaultValue(['%kernel.root_dir%/themes'])
                        ->requiresAtLeastOneElement()
                        ->performNoDeepMerging()
                        ->prototype('scalar')
                    ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function initializeSource(ContainerBuilder $container, array $config): Definition
    {
        $recursiveFileLocator = new Definition(RecursiveFileLocator::class, [
            new Reference('sylius.theme.finder_factory'),
            $config['directories'],
        ]);

        $configurationLoader = new Definition(ProcessingConfigurationLoader::class, [
            new Definition(JsonFileConfigurationLoader::class, [
                new Reference('sylius.theme.filesystem'),
            ]),
            new Reference('sylius.theme.configuration.processor'),
        ]);

        $configurationProvider = new Definition(FilesystemConfigurationProvider::class, [
            $recursiveFileLocator,
            $configurationLoader,
            $config['filename'],
        ]);

        return $configurationProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'filesystem';
    }
}
