<?php

declare(strict_types=1);

namespace Component\Attribute\Factory;

use PhpSpec\ObjectBehavior;
use Component\Attribute\AttributeType\AttributeTypeInterface;
use Component\Attribute\Factory\AttributeFactory;
use Component\Attribute\Factory\AttributeFactoryInterface;
use Component\Attribute\Model\Attribute;
use Component\Registry\ServiceRegistryInterface;
use Component\Resource\Factory\FactoryInterface;

final class AttributeFactorySpec extends ObjectBehavior
{
    function let(FactoryInterface $factory, ServiceRegistryInterface $attributeTypesRegistry): void
    {
        $this->beConstructedWith($factory, $attributeTypesRegistry);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(AttributeFactory::class);
    }

    function it_implements_attribute_factory_interface(): void
    {
        $this->shouldImplement(AttributeFactoryInterface::class);
    }

    function it_creates_untyped_attribute(
        FactoryInterface $factory,
        Attribute $untypedAttribute
    ): void {
        $factory->createNew()->willReturn($untypedAttribute);

        $this->createNew()->shouldReturn($untypedAttribute);
    }

    function it_creates_typed_attribute(
        Attribute $typedAttribute,
        AttributeTypeInterface $attributeType,
        FactoryInterface $factory,
        ServiceRegistryInterface $attributeTypesRegistry
    ): void {
        $factory->createNew()->willReturn($typedAttribute);

        $attributeType->getStorageType()->willReturn('datetime');
        $attributeTypesRegistry->get('datetime')->willReturn($attributeType);

        $typedAttribute->setType('datetime')->shouldBeCalled();
        $typedAttribute->getType()->willReturn('datetime');
        $typedAttribute->setStorageType('datetime')->shouldBeCalled();

        $this->createTyped('datetime')->shouldReturn($typedAttribute);
    }
}
