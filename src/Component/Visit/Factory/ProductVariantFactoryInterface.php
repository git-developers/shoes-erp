<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Component\Product\Factory;

use Component\Product\Model\ProductInterface;
use Component\Product\Model\ProductVariantInterface;
use Component\Resource\Factory\FactoryInterface;

interface ProductVariantFactoryInterface extends FactoryInterface
{
    /**
     * @param ProductInterface $product
     *
     * @return ProductVariantInterface
     */
    public function createForProduct(ProductInterface $product): ProductVariantInterface;
}
