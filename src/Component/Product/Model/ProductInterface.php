<?php

declare(strict_types=1);

namespace Component\Product\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ProductInterface extends
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
     * @return Collection|ProductVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param ProductVariantInterface $variant
     */
    public function addVariant(ProductVariantInterface $variant): void;

    /**
     * @param ProductVariantInterface $variant
     */
    public function removeVariant(ProductVariantInterface $variant): void;

    /**
     * @param ProductVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(ProductVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|ProductOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param ProductOptionInterface $option
     */
    public function addOption(ProductOptionInterface $option): void;

    /**
     * @param ProductOptionInterface $option
     */
    public function removeOption(ProductOptionInterface $option): void;

    /**
     * @param ProductOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(ProductOptionInterface $option): bool;

    /**
     * @return Collection|ProductAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param ProductAssociationInterface $association
     */
    public function addAssociation(ProductAssociationInterface $association): void;

    /**
     * @param ProductAssociationInterface $association
     */
    public function removeAssociation(ProductAssociationInterface $association): void;

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
     * @return ProductTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
