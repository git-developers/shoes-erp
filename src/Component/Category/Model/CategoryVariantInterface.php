<?php

declare(strict_types=1);

namespace Component\Category\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface CategoryVariantInterface extends
    TimestampableInterface,
    ResourceInterface,
    CodeAwareInterface,
    TranslatableInterface
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
     * @return string
     */
    public function getDescriptor(): string;

    /**
     * @return Collection|CategoryOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param CategoryOptionValueInterface $optionValue
     */
    public function addOptionValue(CategoryOptionValueInterface $optionValue): void;

    /**
     * @param CategoryOptionValueInterface $optionValue
     */
    public function removeOptionValue(CategoryOptionValueInterface $optionValue): void;

    /**
     * @param CategoryOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(CategoryOptionValueInterface $optionValue): bool;

    /**
     * @return CategoryInterface|null
     */
    public function getCategory(): ?CategoryInterface;

    /**
     * @param CategoryInterface|null $Category
     */
    public function setCategory(?CategoryInterface $Category): void;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void;

    /**
     * @param string|null $locale
     *
     * @return CategoryVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
