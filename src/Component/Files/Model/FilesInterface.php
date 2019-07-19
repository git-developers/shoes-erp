<?php

declare(strict_types=1);

namespace Component\Files\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface FilesInterface extends
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
     * @return Collection|FilesVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param FilesVariantInterface $variant
     */
    public function addVariant(FilesVariantInterface $variant): void;

    /**
     * @param FilesVariantInterface $variant
     */
    public function removeVariant(FilesVariantInterface $variant): void;

    /**
     * @param FilesVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(FilesVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|FilesOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param FilesOptionInterface $option
     */
    public function addOption(FilesOptionInterface $option): void;

    /**
     * @param FilesOptionInterface $option
     */
    public function removeOption(FilesOptionInterface $option): void;

    /**
     * @param FilesOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(FilesOptionInterface $option): bool;

    /**
     * @return Collection|FilesAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param FilesAssociationInterface $association
     */
    public function addAssociation(FilesAssociationInterface $association): void;

    /**
     * @param FilesAssociationInterface $association
     */
    public function removeAssociation(FilesAssociationInterface $association): void;

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
     * @return FilesTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
