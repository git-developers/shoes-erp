<?php

declare(strict_types=1);

namespace Component\Booking\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface BookingInterface extends
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
     * @return Collection|BookingVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param BookingVariantInterface $variant
     */
    public function addVariant(BookingVariantInterface $variant): void;

    /**
     * @param BookingVariantInterface $variant
     */
    public function removeVariant(BookingVariantInterface $variant): void;

    /**
     * @param BookingVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(BookingVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|BookingOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param BookingOptionInterface $option
     */
    public function addOption(BookingOptionInterface $option): void;

    /**
     * @param BookingOptionInterface $option
     */
    public function removeOption(BookingOptionInterface $option): void;

    /**
     * @param BookingOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(BookingOptionInterface $option): bool;

    /**
     * @return Collection|BookingAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param BookingAssociationInterface $association
     */
    public function addAssociation(BookingAssociationInterface $association): void;

    /**
     * @param BookingAssociationInterface $association
     */
    public function removeAssociation(BookingAssociationInterface $association): void;

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
     * @return BookingTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
