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

namespace Component\Taxation\Resolver;

use Component\Taxation\Model\TaxableInterface;
use Component\Taxation\Model\TaxRateInterface;

interface TaxRateResolverInterface
{
    /**
     * @param TaxableInterface $taxable
     * @param array $criteria
     *
     * @return TaxRateInterface|null
     */
    public function resolve(TaxableInterface $taxable, array $criteria = []): ?TaxRateInterface;
}
