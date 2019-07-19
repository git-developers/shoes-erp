<?php

declare(strict_types=1);

namespace Component\Pdvhasproduct\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface PdvhasproductOptionInterface extends
    ResourceInterface,
    CodeAwareInterface,
    TimestampableInterface,
    TranslatableInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;

    /**
     * @return int
     */
    public function getPosition(): ?int;

    /**
     * @param int $position
     */
    public function setPosition(?int $position): void;

    /**
     * @return Collection|PdvhasproductOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param PdvhasproductOptionValueInterface $optionValue
     */
    public function addValue(PdvhasproductOptionValueInterface $optionValue): void;

    /**
     * @param PdvhasproductOptionValueInterface $optionValue
     */
    public function removeValue(PdvhasproductOptionValueInterface $optionValue): void;

    /**
     * @param PdvhasproductOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(PdvhasproductOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return PdvhasproductOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
