<?php

declare(strict_types=1);

namespace Component\Settings\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface SettingsVariantInterface extends
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
     * @return Collection|SettingsOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param SettingsOptionValueInterface $optionValue
     */
    public function addOptionValue(SettingsOptionValueInterface $optionValue): void;

    /**
     * @param SettingsOptionValueInterface $optionValue
     */
    public function removeOptionValue(SettingsOptionValueInterface $optionValue): void;

    /**
     * @param SettingsOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(SettingsOptionValueInterface $optionValue): bool;

    /**
     * @return SettingsInterface|null
     */
    public function getSettings(): ?SettingsInterface;

    /**
     * @param SettingsInterface|null $Settings
     */
    public function setSettings(?SettingsInterface $Settings): void;

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
     * @return SettingsVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
