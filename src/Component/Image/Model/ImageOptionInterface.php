<?php

declare(strict_types=1);

namespace Component\Image\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ImageOptionInterface extends
    ResourceInterface,
    CodeAwareInterface,
    TimestampableInterface,
    TranslatableInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;

    /**
     * @return int
     */
    public function getPosition(): ?int;

    /**
     * @param int $position
     */
    public function setPosition(?int $position): void;

    /**
     * @return Collection|ImageOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param ImageOptionValueInterface $optionValue
     */
    public function addValue(ImageOptionValueInterface $optionValue): void;

    /**
     * @param ImageOptionValueInterface $optionValue
     */
    public function removeValue(ImageOptionValueInterface $optionValue): void;

    /**
     * @param ImageOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(ImageOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return ImageOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
