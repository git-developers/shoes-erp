<?php

declare(strict_types=1);

namespace Component\Module\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ModuleInterface extends
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
     * @return Collection|ModuleVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param ModuleVariantInterface $variant
     */
    public function addVariant(ModuleVariantInterface $variant): void;

    /**
     * @param ModuleVariantInterface $variant
     */
    public function removeVariant(ModuleVariantInterface $variant): void;

    /**
     * @param ModuleVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(ModuleVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|ModuleOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param ModuleOptionInterface $option
     */
    public function addOption(ModuleOptionInterface $option): void;

    /**
     * @param ModuleOptionInterface $option
     */
    public function removeOption(ModuleOptionInterface $option): void;

    /**
     * @param ModuleOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(ModuleOptionInterface $option): bool;

    /**
     * @return Collection|ModuleAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param ModuleAssociationInterface $association
     */
    public function addAssociation(ModuleAssociationInterface $association): void;

    /**
     * @param ModuleAssociationInterface $association
     */
    public function removeAssociation(ModuleAssociationInterface $association): void;

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
     * @return ModuleTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
