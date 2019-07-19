<?php

declare(strict_types=1);

namespace Component\Session\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface SessionInterface extends
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
     * @return Collection|SessionVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param SessionVariantInterface $variant
     */
    public function addVariant(SessionVariantInterface $variant): void;

    /**
     * @param SessionVariantInterface $variant
     */
    public function removeVariant(SessionVariantInterface $variant): void;

    /**
     * @param SessionVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(SessionVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|SessionOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param SessionOptionInterface $option
     */
    public function addOption(SessionOptionInterface $option): void;

    /**
     * @param SessionOptionInterface $option
     */
    public function removeOption(SessionOptionInterface $option): void;

    /**
     * @param SessionOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(SessionOptionInterface $option): bool;

    /**
     * @return Collection|SessionAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param SessionAssociationInterface $association
     */
    public function addAssociation(SessionAssociationInterface $association): void;

    /**
     * @param SessionAssociationInterface $association
     */
    public function removeAssociation(SessionAssociationInterface $association): void;

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
     * @return SessionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
