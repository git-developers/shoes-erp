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

namespace Component\Product\Resolver;

use Component\Product\Model\ProductInterface;
use Component\Product\Model\ProductVariantInterface;

interface ProductVariantResolverInterface
{
    /**
     * @param ProductInterface $subject
     *
     * @return ProductVariantInterface|null
     */
    public function getVariant(ProductInterface $subject): ?ProductVariantInterface;
}
