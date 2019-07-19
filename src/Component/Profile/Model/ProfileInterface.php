<?php

declare(strict_types=1);

namespace Component\Profile\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ProfileInterface extends
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
     * @return Collection|ProfileVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param ProfileVariantInterface $variant
     */
    public function addVariant(ProfileVariantInterface $variant): void;

    /**
     * @param ProfileVariantInterface $variant
     */
    public function removeVariant(ProfileVariantInterface $variant): void;

    /**
     * @param ProfileVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(ProfileVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|ProfileOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param ProfileOptionInterface $option
     */
    public function addOption(ProfileOptionInterface $option): void;

    /**
     * @param ProfileOptionInterface $option
     */
    public function removeOption(ProfileOptionInterface $option): void;

    /**
     * @param ProfileOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(ProfileOptionInterface $option): bool;

    /**
     * @return Collection|ProfileAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param ProfileAssociationInterface $association
     */
    public function addAssociation(ProfileAssociationInterface $association): void;

    /**
     * @param ProfileAssociationInterface $association
     */
    public function removeAssociation(ProfileAssociationInterface $association): void;

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
     * @return ProfileTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
