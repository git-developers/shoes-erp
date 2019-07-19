<?php

declare(strict_types=1);

namespace Component\Order\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface OrderinInterface extends
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
     * @return Collection|OrderinVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param OrderinVariantInterface $variant
     */
    public function addVariant(OrderinVariantInterface $variant): void;

    /**
     * @param OrderinVariantInterface $variant
     */
    public function removeVariant(OrderinVariantInterface $variant): void;

    /**
     * @param OrderinVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(OrderinVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|OrderinOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param OrderinOptionInterface $option
     */
    public function addOption(OrderinOptionInterface $option): void;

    /**
     * @param OrderinOptionInterface $option
     */
    public function removeOption(OrderinOptionInterface $option): void;

    /**
     * @param OrderinOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(OrderinOptionInterface $option): bool;

    /**
     * @return Collection|OrderinAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param OrderinAssociationInterface $association
     */
    public function addAssociation(OrderinAssociationInterface $association): void;

    /**
     * @param OrderinAssociationInterface $association
     */
    public function removeAssociation(OrderinAssociationInterface $association): void;

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
     * @return OrderinTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
