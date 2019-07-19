<?php

declare(strict_types=1);

namespace Component\Groupofusers\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GroupofusersInterface extends
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
     * @return Collection|GroupofusersVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param GroupofusersVariantInterface $variant
     */
    public function addVariant(GroupofusersVariantInterface $variant): void;

    /**
     * @param GroupofusersVariantInterface $variant
     */
    public function removeVariant(GroupofusersVariantInterface $variant): void;

    /**
     * @param GroupofusersVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(GroupofusersVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|GroupofusersOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param GroupofusersOptionInterface $option
     */
    public function addOption(GroupofusersOptionInterface $option): void;

    /**
     * @param GroupofusersOptionInterface $option
     */
    public function removeOption(GroupofusersOptionInterface $option): void;

    /**
     * @param GroupofusersOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(GroupofusersOptionInterface $option): bool;

    /**
     * @return Collection|GroupofusersAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param GroupofusersAssociationInterface $association
     */
    public function addAssociation(GroupofusersAssociationInterface $association): void;

    /**
     * @param GroupofusersAssociationInterface $association
     */
    public function removeAssociation(GroupofusersAssociationInterface $association): void;

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
     * @return GroupofusersTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
