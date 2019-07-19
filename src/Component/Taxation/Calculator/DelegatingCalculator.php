<?php

declare(strict_types=1);

namespace Component\Taxation\Calculator;

use Component\Registry\ServiceRegistryInterface;
use Component\Taxation\Model\TaxRateInterface;

final class DelegatingCalculator implements CalculatorInterface
{
    /**
     * @var ServiceRegistryInterface
     */
    private $calculatorsRegistry;

    /**
     * @param ServiceRegistryInterface $serviceRegistry
     */
    public function __construct(ServiceRegistryInterface $serviceRegistry)
    {
        $this->calculatorsRegistry = $serviceRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function calculate(float $base, TaxRateInterface $rate): float
    {
        /** @var CalculatorInterface $calculator */
        $calculator = $this->calculatorsRegistry->get($rate->getCalculator());

        return $calculator->calculate($base, $rate);
    }
}
