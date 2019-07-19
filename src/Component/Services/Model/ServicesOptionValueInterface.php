<?php

declare(strict_types=1);

namespace Component\Services\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ServicesOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return ServicesOptionInterface
     */
    public function getOption(): ?ServicesOptionInterface;

    /**
     * @param ServicesOptionInterface $option
     */
    public function setOption(?ServicesOptionInterface $option): void;

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
     * @return ServicesOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
