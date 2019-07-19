<?php

declare(strict_types=1);

namespace Component\Image\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ImageVariantInterface extends
    TimestampableInterface,
    ResourceInterface,
    CodeAwareInterface,
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
     * @return string
     */
    public function getDescriptor(): string;

    /**
     * @return Collection|ImageOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param ImageOptionValueInterface $optionValue
     */
    public function addOptionValue(ImageOptionValueInterface $optionValue): void;

    /**
     * @param ImageOptionValueInterface $optionValue
     */
    public function removeOptionValue(ImageOptionValueInterface $optionValue): void;

    /**
     * @param ImageOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(ImageOptionValueInterface $optionValue): bool;

    /**
     * @return ImageInterface|null
     */
    public function getImage(): ?ImageInterface;

    /**
     * @param ImageInterface|null $Image
     */
    public function setImage(?ImageInterface $Image): void;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void;

    /**
     * @param string|null $locale
     *
     * @return ImageVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
