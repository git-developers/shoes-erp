<?php

declare(strict_types=1);

namespace Component\Profile\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ProfileVariantInterface extends
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
     * @return Collection|ProfileOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param ProfileOptionValueInterface $optionValue
     */
    public function addOptionValue(ProfileOptionValueInterface $optionValue): void;

    /**
     * @param ProfileOptionValueInterface $optionValue
     */
    public function removeOptionValue(ProfileOptionValueInterface $optionValue): void;

    /**
     * @param ProfileOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(ProfileOptionValueInterface $optionValue): bool;

    /**
     * @return ProfileInterface|null
     */
    public function getProfile(): ?ProfileInterface;

    /**
     * @param ProfileInterface|null $Profile
     */
    public function setProfile(?ProfileInterface $Profile): void;

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
     * @return ProfileVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
