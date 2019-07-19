<?php

declare(strict_types=1);

namespace Component\Category\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface CategoryOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return CategoryOptionInterface
     */
    public function getOption(): ?CategoryOptionInterface;

    /**
     * @param CategoryOptionInterface $option
     */
    public function setOption(?CategoryOptionInterface $option): void;

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
     * @return CategoryOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
