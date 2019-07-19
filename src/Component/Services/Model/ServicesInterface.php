<?php

declare(strict_types=1);

namespace Component\Services\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ServicesInterface extends
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
     * @return Collection|ServicesVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param ServicesVariantInterface $variant
     */
    public function addVariant(ServicesVariantInterface $variant): void;

    /**
     * @param ServicesVariantInterface $variant
     */
    public function removeVariant(ServicesVariantInterface $variant): void;

    /**
     * @param ServicesVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(ServicesVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|ServicesOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param ServicesOptionInterface $option
     */
    public function addOption(ServicesOptionInterface $option): void;

    /**
     * @param ServicesOptionInterface $option
     */
    public function removeOption(ServicesOptionInterface $option): void;

    /**
     * @param ServicesOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(ServicesOptionInterface $option): bool;

    /**
     * @return Collection|ServicesAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param ServicesAssociationInterface $association
     */
    public function addAssociation(ServicesAssociationInterface $association): void;

    /**
     * @param ServicesAssociationInterface $association
     */
    public function removeAssociation(ServicesAssociationInterface $association): void;

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
     * @return ServicesTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
