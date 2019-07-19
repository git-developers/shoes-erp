<?php

declare(strict_types=1);

namespace Component\Calendar\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface CalendarInterface extends
    AttributeSubjectInterface,
    CodeAwareInterface,
    ResourceInterface,
    SlugAwareInterface,
    TimestampableInterface,
    ToggleableInterface,
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
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void;

    /**
     * @return string|null
     */
    public function getMetaKeywords(): ?string;

    /**
     * @param string|null $metaKeywords
     */
    public function setMetaKeywords(?string $metaKeywords): void;

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string;

    /**
     * @param string|null $metaDescription
     */
    public function setMetaDescription(?string $metaDescription): void;

    /**
     * @return bool
     */
    public function hasVariants(): bool;

    /**
     * @return Collection|CalendarVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param CalendarVariantInterface $variant
     */
    public function addVariant(CalendarVariantInterface $variant): void;

    /**
     * @param CalendarVariantInterface $variant
     */
    public function removeVariant(CalendarVariantInterface $variant): void;

    /**
     * @param CalendarVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(CalendarVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|CalendarOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param CalendarOptionInterface $option
     */
    public function addOption(CalendarOptionInterface $option): void;

    /**
     * @param CalendarOptionInterface $option
     */
    public function removeOption(CalendarOptionInterface $option): void;

    /**
     * @param CalendarOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(CalendarOptionInterface $option): bool;

    /**
     * @return Collection|CalendarAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param CalendarAssociationInterface $association
     */
    public function addAssociation(CalendarAssociationInterface $association): void;

    /**
     * @param CalendarAssociationInterface $association
     */
    public function removeAssociation(CalendarAssociationInterface $association): void;

    /**
     * @return bool
     */
    public function isSimple(): bool;

    /**
     * @return bool
     */
    public function isConfigurable(): bool;

    /**
     * @param string|null $locale
     *
     * @return CalendarTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
