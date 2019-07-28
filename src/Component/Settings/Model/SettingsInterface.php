<?php

declare(strict_types=1);

namespace Component\Settings\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface SettingsInterface extends
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
     * @return Collection|SettingsVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param SettingsVariantInterface $variant
     */
    public function addVariant(SettingsVariantInterface $variant): void;

    /**
     * @param SettingsVariantInterface $variant
     */
    public function removeVariant(SettingsVariantInterface $variant): void;

    /**
     * @param SettingsVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(SettingsVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|SettingsOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param SettingsOptionInterface $option
     */
    public function addOption(SettingsOptionInterface $option): void;

    /**
     * @param SettingsOptionInterface $option
     */
    public function removeOption(SettingsOptionInterface $option): void;

    /**
     * @param SettingsOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(SettingsOptionInterface $option): bool;

    /**
     * @return Collection|SettingsAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param SettingsAssociationInterface $association
     */
    public function addAssociation(SettingsAssociationInterface $association): void;

    /**
     * @param SettingsAssociationInterface $association
     */
    public function removeAssociation(SettingsAssociationInterface $association): void;

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
     * @return SettingsTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
