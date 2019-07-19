<?php

declare(strict_types=1);

namespace Component\Product\Factory;

use Component\Product\Model\ProductInterface;
use Component\Resource\Factory\FactoryInterface;

class ProductFactory implements ProductFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var FactoryInterface
     */
    private $variantFactory;

    /**
     * @param FactoryInterface $factory
     * @param FactoryInterface $variantFactory
     */
    public function __construct(
        FactoryInterface $factory,
        FactoryInterface $variantFactory
    ) {
        $this->factory = $factory;
        $this->variantFactory = $variantFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew(): ProductInterface
    {
        return $this->factory->createNew();
    }

    /**
     * {@inheritdoc}
     */
    public function createWithVariant(): ProductInterface
    {
        $variant = $this->variantFactory->createNew();

        /** @var ProductInterface $product */
        $product = $this->factory->createNew();
        $product->addVariant($variant);

        return $product;
    }
}
