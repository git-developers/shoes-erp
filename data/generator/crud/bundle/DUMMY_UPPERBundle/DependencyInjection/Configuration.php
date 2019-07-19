<?php

declare(strict_types=1);

namespace Bundle\DUMMY_UPPERBundle\DependencyInjection;

use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPERAssociationType;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPERAssociationTypeTranslationType;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPERAssociationTypeType;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPEROptionTranslationType;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPEROptionType;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPEROptionValueTranslationType;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPEROptionValueType;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPERTranslationType;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPER2Type;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPERVariantTranslationType;
use Bundle\DUMMY_UPPERBundle\Form\Type\DUMMY_UPPERVariantType;
use Bundle\ResourceBundle\Controller\ResourceController;
use Bundle\ResourceBundle\ResourceBundle;
use Component\DUMMY_UPPER\Model\DUMMY_UPPER;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERAssociation;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERAssociationInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERAssociationType as DUMMY_UPPERAssociationTypeModel;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERAssociationTypeInterface as DUMMY_UPPERAssociationTypeModelInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERAssociationTypeTranslation;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERAssociationTypeTranslationInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPEROption;
use Component\DUMMY_UPPER\Model\DUMMY_UPPEROptionInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPEROptionTranslation;
use Component\DUMMY_UPPER\Model\DUMMY_UPPEROptionTranslationInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPEROptionValue;
use Component\DUMMY_UPPER\Model\DUMMY_UPPEROptionValueInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPEROptionValueTranslation;
use Component\DUMMY_UPPER\Model\DUMMY_UPPEROptionValueTranslationInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERTranslation;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERTranslationInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERVariant;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERVariantInterface;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERVariantTranslation;
use Component\DUMMY_UPPER\Model\DUMMY_UPPERVariantTranslationInterface;
use Component\Resource\Factory\Factory;
use Component\Resource\Factory\TranslatableFactory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sylius_product');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->defaultValue(ResourceBundle::DRIVER_DOCTRINE_ORM)->end()
            ->end()
        ;

        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addResourcesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('product')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(DUMMY_UPPER::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(DUMMY_UPPERInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(DUMMY_UPPER2Type::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(DUMMY_UPPERTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(DUMMY_UPPERTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(DUMMY_UPPERTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_variant')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(DUMMY_UPPERVariant::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(DUMMY_UPPERVariantInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(DUMMY_UPPERVariantType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(DUMMY_UPPERVariantTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(DUMMY_UPPERVariantTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(DUMMY_UPPERVariantTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_option')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(DUMMY_UPPEROption::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(DUMMY_UPPEROptionInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(DUMMY_UPPEROptionType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(DUMMY_UPPEROptionTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(DUMMY_UPPEROptionTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(DUMMY_UPPEROptionTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_option_value')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(DUMMY_UPPEROptionValue::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(DUMMY_UPPEROptionValueInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(DUMMY_UPPEROptionValueType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->variableNode('option_value')->end()
                                        ->arrayNode('classes')
                                            ->isRequired()
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(DUMMY_UPPEROptionValueTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(DUMMY_UPPEROptionValueTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                                ->scalarNode('form')->defaultValue(DUMMY_UPPEROptionValueTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_association')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(DUMMY_UPPERAssociation::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(DUMMY_UPPERAssociationInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(DUMMY_UPPERAssociationType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('product_association_type')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(DUMMY_UPPERAssociationTypeModel::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(DUMMY_UPPERAssociationTypeModelInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(TranslatableFactory::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->cannotBeEmpty()->end()
                                        ->scalarNode('form')->defaultValue(DUMMY_UPPERAssociationTypeType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(DUMMY_UPPERAssociationTypeTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(DUMMY_UPPERAssociationTypeTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(DUMMY_UPPERAssociationTypeTranslationType::class)->cannotBeEmpty()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
