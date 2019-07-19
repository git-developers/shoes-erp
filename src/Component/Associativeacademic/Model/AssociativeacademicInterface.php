<?php

declare(strict_types=1);

namespace Component\Associativeacademic\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface AssociativeacademicInterface extends
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
     * @return Collection|AssociativeacademicVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param AssociativeacademicVariantInterface $variant
     */
    public function addVariant(AssociativeacademicVariantInterface $variant): void;

    /**
     * @param AssociativeacademicVariantInterface $variant
     */
    public function removeVariant(AssociativeacademicVariantInterface $variant): void;

    /**
     * @param AssociativeacademicVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(AssociativeacademicVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|AssociativeacademicOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param AssociativeacademicOptionInterface $option
     */
    public function addOption(AssociativeacademicOptionInterface $option): void;

    /**
     * @param AssociativeacademicOptionInterface $option
     */
    public function removeOption(AssociativeacademicOptionInterface $option): void;

    /**
     * @param AssociativeacademicOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(AssociativeacademicOptionInterface $option): bool;

    /**
     * @return Collection|AssociativeacademicAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param AssociativeacademicAssociationInterface $association
     */
    public function addAssociation(AssociativeacademicAssociationInterface $association): void;

    /**
     * @param AssociativeacademicAssociationInterface $association
     */
    public function removeAssociation(AssociativeacademicAssociationInterface $association): void;

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
     * @return AssociativeacademicTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
