<?php

declare(strict_types=1);

namespace Component\Category\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface CategoryInterface extends
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
     * @return Collection|CategoryVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param CategoryVariantInterface $variant
     */
    public function addVariant(CategoryVariantInterface $variant): void;

    /**
     * @param CategoryVariantInterface $variant
     */
    public function removeVariant(CategoryVariantInterface $variant): void;

    /**
     * @param CategoryVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(CategoryVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|CategoryOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param CategoryOptionInterface $option
     */
    public function addOption(CategoryOptionInterface $option): void;

    /**
     * @param CategoryOptionInterface $option
     */
    public function removeOption(CategoryOptionInterface $option): void;

    /**
     * @param CategoryOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(CategoryOptionInterface $option): bool;

    /**
     * @return Collection|CategoryAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param CategoryAssociationInterface $association
     */
    public function addAssociation(CategoryAssociationInterface $association): void;

    /**
     * @param CategoryAssociationInterface $association
     */
    public function removeAssociation(CategoryAssociationInterface $association): void;

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
     * @return CategoryTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
