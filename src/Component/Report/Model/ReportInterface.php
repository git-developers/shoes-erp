<?php

declare(strict_types=1);

namespace Component\Report\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ReportInterface extends
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
     * @return Collection|ReportVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param ReportVariantInterface $variant
     */
    public function addVariant(ReportVariantInterface $variant): void;

    /**
     * @param ReportVariantInterface $variant
     */
    public function removeVariant(ReportVariantInterface $variant): void;

    /**
     * @param ReportVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(ReportVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|ReportOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param ReportOptionInterface $option
     */
    public function addOption(ReportOptionInterface $option): void;

    /**
     * @param ReportOptionInterface $option
     */
    public function removeOption(ReportOptionInterface $option): void;

    /**
     * @param ReportOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(ReportOptionInterface $option): bool;

    /**
     * @return Collection|ReportAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param ReportAssociationInterface $association
     */
    public function addAssociation(ReportAssociationInterface $association): void;

    /**
     * @param ReportAssociationInterface $association
     */
    public function removeAssociation(ReportAssociationInterface $association): void;

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
     * @return ReportTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
