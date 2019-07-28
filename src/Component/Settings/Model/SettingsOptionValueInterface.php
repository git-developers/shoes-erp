<?php

declare(strict_types=1);

namespace Component\Settings\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface SettingsOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return SettingsOptionInterface
     */
    public function getOption(): ?SettingsOptionInterface;

    /**
     * @param SettingsOptionInterface $option
     */
    public function setOption(?SettingsOptionInterface $option): void;

    /**
     * @return string|null
     */
    public function getValue(): ?string;

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void;

    /**
     * @return string|null
     */
    public function getOptionCode(): ?string;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $locale
     *
     * @return SettingsOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
