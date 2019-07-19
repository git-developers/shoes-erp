<?php

declare(strict_types=1);

namespace Component\Image\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ImageInterface extends
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
     * @return Collection|ImageVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param ImageVariantInterface $variant
     */
    public function addVariant(ImageVariantInterface $variant): void;

    /**
     * @param ImageVariantInterface $variant
     */
    public function removeVariant(ImageVariantInterface $variant): void;

    /**
     * @param ImageVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(ImageVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|ImageOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param ImageOptionInterface $option
     */
    public function addOption(ImageOptionInterface $option): void;

    /**
     * @param ImageOptionInterface $option
     */
    public function removeOption(ImageOptionInterface $option): void;

    /**
     * @param ImageOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(ImageOptionInterface $option): bool;

    /**
     * @return Collection|ImageAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param ImageAssociationInterface $association
     */
    public function addAssociation(ImageAssociationInterface $association): void;

    /**
     * @param ImageAssociationInterface $association
     */
    public function removeAssociation(ImageAssociationInterface $association): void;

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
     * @return ImageTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
