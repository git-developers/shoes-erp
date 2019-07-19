<?php

declare(strict_types=1);

namespace Component\Role\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface RoleInterface extends
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
     * @return Collection|RoleVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param RoleVariantInterface $variant
     */
    public function addVariant(RoleVariantInterface $variant): void;

    /**
     * @param RoleVariantInterface $variant
     */
    public function removeVariant(RoleVariantInterface $variant): void;

    /**
     * @param RoleVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(RoleVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|RoleOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param RoleOptionInterface $option
     */
    public function addOption(RoleOptionInterface $option): void;

    /**
     * @param RoleOptionInterface $option
     */
    public function removeOption(RoleOptionInterface $option): void;

    /**
     * @param RoleOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(RoleOptionInterface $option): bool;

    /**
     * @return Collection|RoleAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param RoleAssociationInterface $association
     */
    public function addAssociation(RoleAssociationInterface $association): void;

    /**
     * @param RoleAssociationInterface $association
     */
    public function removeAssociation(RoleAssociationInterface $association): void;

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
     * @return RoleTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
