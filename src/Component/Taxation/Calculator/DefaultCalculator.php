<?php

declare(strict_types=1);

namespace Component\Taxation\Calculator;

use Component\Taxation\Model\TaxRateInterface;

final class DefaultCalculator implements CalculatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function calculate(float $base, TaxRateInterface $rate): float
    {
        if ($rate->isIncludedInPrice()) {
            return round($base - ($base / (1 + $rate->getAmount())));
        }

        return round($base * $rate->getAmount());
    }
}
