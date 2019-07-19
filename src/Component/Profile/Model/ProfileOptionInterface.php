<?php

declare(strict_types=1);

namespace Component\Profile\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ProfileOptionInterface extends
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
     * @return Collection|ProfileOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param ProfileOptionValueInterface $optionValue
     */
    public function addValue(ProfileOptionValueInterface $optionValue): void;

    /**
     * @param ProfileOptionValueInterface $optionValue
     */
    public function removeValue(ProfileOptionValueInterface $optionValue): void;

    /**
     * @param ProfileOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(ProfileOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return ProfileOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
