<?php

declare(strict_types=1);

namespace Component\Route\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface RouteOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return RouteOptionInterface
     */
    public function getOption(): ?RouteOptionInterface;

    /**
     * @param RouteOptionInterface $option
     */
    public function setOption(?RouteOptionInterface $option): void;

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
     * @return RouteOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
