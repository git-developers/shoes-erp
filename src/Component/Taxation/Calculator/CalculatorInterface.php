<?php

declare(strict_types=1);

namespace Component\Taxation\Calculator;

use Component\Taxation\Model\TaxRateInterface;

interface CalculatorInterface
{
    /**
     * @param float $base
     * @param TaxRateInterface $rate
     *
     * @return float
     */
    public function calculate(float $base, TaxRateInterface $rate): float;
}
