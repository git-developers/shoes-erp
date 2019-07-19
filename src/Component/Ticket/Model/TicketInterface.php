<?php

declare(strict_types=1);

namespace Component\Ticket\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface TicketInterface extends
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
     * @return Collection|TicketVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param TicketVariantInterface $variant
     */
    public function addVariant(TicketVariantInterface $variant): void;

    /**
     * @param TicketVariantInterface $variant
     */
    public function removeVariant(TicketVariantInterface $variant): void;

    /**
     * @param TicketVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(TicketVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|TicketOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param TicketOptionInterface $option
     */
    public function addOption(TicketOptionInterface $option): void;

    /**
     * @param TicketOptionInterface $option
     */
    public function removeOption(TicketOptionInterface $option): void;

    /**
     * @param TicketOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(TicketOptionInterface $option): bool;

    /**
     * @return Collection|TicketAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param TicketAssociationInterface $association
     */
    public function addAssociation(TicketAssociationInterface $association): void;

    /**
     * @param TicketAssociationInterface $association
     */
    public function removeAssociation(TicketAssociationInterface $association): void;

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
     * @return TicketTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
