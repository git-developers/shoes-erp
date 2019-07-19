<?php

declare(strict_types=1);

namespace Component\Pdvhasproduct\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface PdvhasproductInterface extends
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
     * @return Collection|PdvhasproductVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param PdvhasproductVariantInterface $variant
     */
    public function addVariant(PdvhasproductVariantInterface $variant): void;

    /**
     * @param PdvhasproductVariantInterface $variant
     */
    public function removeVariant(PdvhasproductVariantInterface $variant): void;

    /**
     * @param PdvhasproductVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(PdvhasproductVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|PdvhasproductOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param PdvhasproductOptionInterface $option
     */
    public function addOption(PdvhasproductOptionInterface $option): void;

    /**
     * @param PdvhasproductOptionInterface $option
     */
    public function removeOption(PdvhasproductOptionInterface $option): void;

    /**
     * @param PdvhasproductOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(PdvhasproductOptionInterface $option): bool;

    /**
     * @return Collection|PdvhasproductAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param PdvhasproductAssociationInterface $association
     */
    public function addAssociation(PdvhasproductAssociationInterface $association): void;

    /**
     * @param PdvhasproductAssociationInterface $association
     */
    public function removeAssociation(PdvhasproductAssociationInterface $association): void;

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
     * @return PdvhasproductTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
