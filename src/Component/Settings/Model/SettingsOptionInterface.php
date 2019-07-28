<?php

declare(strict_types=1);

namespace Component\Settings\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface SettingsOptionInterface extends
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
     * @return Collection|SettingsOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param SettingsOptionValueInterface $optionValue
     */
    public function addValue(SettingsOptionValueInterface $optionValue): void;

    /**
     * @param SettingsOptionValueInterface $optionValue
     */
    public function removeValue(SettingsOptionValueInterface $optionValue): void;

    /**
     * @param SettingsOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(SettingsOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return SettingsOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
