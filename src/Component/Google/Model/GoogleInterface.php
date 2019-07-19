<?php

declare(strict_types=1);

namespace Component\Google\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GoogleInterface extends
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
     * @return Collection|GoogleVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param GoogleVariantInterface $variant
     */
    public function addVariant(GoogleVariantInterface $variant): void;

    /**
     * @param GoogleVariantInterface $variant
     */
    public function removeVariant(GoogleVariantInterface $variant): void;

    /**
     * @param GoogleVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(GoogleVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|GoogleOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param GoogleOptionInterface $option
     */
    public function addOption(GoogleOptionInterface $option): void;

    /**
     * @param GoogleOptionInterface $option
     */
    public function removeOption(GoogleOptionInterface $option): void;

    /**
     * @param GoogleOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(GoogleOptionInterface $option): bool;

    /**
     * @return Collection|GoogleAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param GoogleAssociationInterface $association
     */
    public function addAssociation(GoogleAssociationInterface $association): void;

    /**
     * @param GoogleAssociationInterface $association
     */
    public function removeAssociation(GoogleAssociationInterface $association): void;

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
     * @return GoogleTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
