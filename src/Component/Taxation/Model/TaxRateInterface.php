<?php

declare(strict_types=1);

namespace Component\Taxation\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface TaxRateInterface extends CodeAwareInterface, TimestampableInterface, ResourceInterface
{
    /**
     * @return TaxCategoryInterface|null
     */
    public function getCategory(): ?TaxCategoryInterface;

    /**
     * @param TaxCategoryInterface|null $category
     */
    public function setCategory(?TaxCategoryInterface $category): void;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * @return float
     */
    public function getAmount(): float;

    /**
     * @return float
     */
    public function getAmountAsPercentage(): float;

    /**
     * @param float|null $amount
     */
    public function setAmount(?float $amount): void;

    /**
     * @return bool
     */
    public function isIncludedInPrice(): bool;

    /**
     * @param bool|null $includedInPrice
     */
    public function setIncludedInPrice(?bool $includedInPrice): void;

    /**
     * @return string|null
     */
    public function getCalculator(): ?string;

    /**
     * @param string|null $calculator
     */
    public function setCalculator(?string $calculator): void;

    /**
     * @return string|null
     */
    public function getLabel(): ?string;
}
