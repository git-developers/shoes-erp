<?php

declare(strict_types=1);

namespace Component\Category\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface CategoryOptionInterface extends
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
     * @return Collection|CategoryOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param CategoryOptionValueInterface $optionValue
     */
    public function addValue(CategoryOptionValueInterface $optionValue): void;

    /**
     * @param CategoryOptionValueInterface $optionValue
     */
    public function removeValue(CategoryOptionValueInterface $optionValue): void;

    /**
     * @param CategoryOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(CategoryOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return CategoryOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
