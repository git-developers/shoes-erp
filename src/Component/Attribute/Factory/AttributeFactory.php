<?php

declare(strict_types=1);

namespace Component\Attribute\Factory;

use Component\Attribute\AttributeType\AttributeTypeInterface;
use Component\Attribute\Model\AttributeInterface;
use Component\Registry\ServiceRegistryInterface;
use Component\Resource\Factory\FactoryInterface;

final class AttributeFactory implements AttributeFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var ServiceRegistryInterface
     */
    private $attributeTypesRegistry;

    /**
     * @param FactoryInterface $factory
     * @param ServiceRegistryInterface $attributeTypesRegistry
     */
    public function __construct(FactoryInterface $factory, ServiceRegistryInterface $attributeTypesRegistry)
    {
        $this->factory = $factory;
        $this->attributeTypesRegistry = $attributeTypesRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew(): AttributeInterface
    {
        return $this->factory->createNew();
    }

    /**
     * {@inheritdoc}
     */
    public function createTyped(string $type): AttributeInterface
    {
        /** @var AttributeTypeInterface $attributeType */
        $attributeType = $this->attributeTypesRegistry->get($type);

        /** @var AttributeInterface $attribute */
        $attribute = $this->factory->createNew();
        $attribute->setType($type);
        $attribute->setStorageType($attributeType->getStorageType());

        return $attribute;
    }
}
