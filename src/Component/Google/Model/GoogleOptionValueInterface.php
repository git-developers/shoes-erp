<?php

declare(strict_types=1);

namespace Component\Google\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GoogleOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return GoogleOptionInterface
     */
    public function getOption(): ?GoogleOptionInterface;

    /**
     * @param GoogleOptionInterface $option
     */
    public function setOption(?GoogleOptionInterface $option): void;

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
     * @return GoogleOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
