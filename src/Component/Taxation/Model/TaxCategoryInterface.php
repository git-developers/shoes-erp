<?php

declare(strict_types=1);

namespace Component\Taxation\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface TaxCategoryInterface extends CodeAwareInterface, TimestampableInterface, ResourceInterface
{
    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void;

    /**
     * @return Collection|TaxRateInterface[]
     */
    public function getRates(): Collection;

    /**
     * @param TaxRateInterface $rate
     */
    public function addRate(TaxRateInterface $rate): void;

    /**
     * @param TaxRateInterface $rate
     */
    public function removeRate(TaxRateInterface $rate): void;

    /**
     * @param TaxRateInterface $rate
     *
     * @return bool
     */
    public function hasRate(TaxRateInterface $rate): bool;
}
