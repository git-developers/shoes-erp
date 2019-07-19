<?php

declare(strict_types=1);

namespace Component\Visit\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface VisitInterface extends
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
     * @return Collection|VisitVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param VisitVariantInterface $variant
     */
    public function addVariant(VisitVariantInterface $variant): void;

    /**
     * @param VisitVariantInterface $variant
     */
    public function removeVariant(VisitVariantInterface $variant): void;

    /**
     * @param VisitVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(VisitVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|VisitOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param VisitOptionInterface $option
     */
    public function addOption(VisitOptionInterface $option): void;

    /**
     * @param VisitOptionInterface $option
     */
    public function removeOption(VisitOptionInterface $option): void;

    /**
     * @param VisitOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(VisitOptionInterface $option): bool;

    /**
     * @return Collection|VisitAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param VisitAssociationInterface $association
     */
    public function addAssociation(VisitAssociationInterface $association): void;

    /**
     * @param VisitAssociationInterface $association
     */
    public function removeAssociation(VisitAssociationInterface $association): void;

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
     * @return VisitTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
