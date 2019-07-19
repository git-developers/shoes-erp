<?php

declare(strict_types=1);

namespace Component\DUMMY_UPPER\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface DUMMY_UPPERInterface extends
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
     * @return Collection|DUMMY_UPPERVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param DUMMY_UPPERVariantInterface $variant
     */
    public function addVariant(DUMMY_UPPERVariantInterface $variant): void;

    /**
     * @param DUMMY_UPPERVariantInterface $variant
     */
    public function removeVariant(DUMMY_UPPERVariantInterface $variant): void;

    /**
     * @param DUMMY_UPPERVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(DUMMY_UPPERVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|DUMMY_UPPEROptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param DUMMY_UPPEROptionInterface $option
     */
    public function addOption(DUMMY_UPPEROptionInterface $option): void;

    /**
     * @param DUMMY_UPPEROptionInterface $option
     */
    public function removeOption(DUMMY_UPPEROptionInterface $option): void;

    /**
     * @param DUMMY_UPPEROptionInterface $option
     *
     * @return bool
     */
    public function hasOption(DUMMY_UPPEROptionInterface $option): bool;

    /**
     * @return Collection|DUMMY_UPPERAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param DUMMY_UPPERAssociationInterface $association
     */
    public function addAssociation(DUMMY_UPPERAssociationInterface $association): void;

    /**
     * @param DUMMY_UPPERAssociationInterface $association
     */
    public function removeAssociation(DUMMY_UPPERAssociationInterface $association): void;

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
     * @return DUMMY_UPPERTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
