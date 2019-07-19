<?php

declare(strict_types=1);

namespace Component\Pointofsale\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface PointofsaleInterface extends
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
     * @return Collection|PointofsaleVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param PointofsaleVariantInterface $variant
     */
    public function addVariant(PointofsaleVariantInterface $variant): void;

    /**
     * @param PointofsaleVariantInterface $variant
     */
    public function removeVariant(PointofsaleVariantInterface $variant): void;

    /**
     * @param PointofsaleVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(PointofsaleVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|PointofsaleOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param PointofsaleOptionInterface $option
     */
    public function addOption(PointofsaleOptionInterface $option): void;

    /**
     * @param PointofsaleOptionInterface $option
     */
    public function removeOption(PointofsaleOptionInterface $option): void;

    /**
     * @param PointofsaleOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(PointofsaleOptionInterface $option): bool;

    /**
     * @return Collection|PointofsaleAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param PointofsaleAssociationInterface $association
     */
    public function addAssociation(PointofsaleAssociationInterface $association): void;

    /**
     * @param PointofsaleAssociationInterface $association
     */
    public function removeAssociation(PointofsaleAssociationInterface $association): void;

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
     * @return PointofsaleTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
