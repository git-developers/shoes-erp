<?php

declare(strict_types=1);

namespace Component\Order\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface OrderinOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return OrderinOptionInterface
     */
    public function getOption(): ?OrderinOptionInterface;

    /**
     * @param OrderinOptionInterface $option
     */
    public function setOption(?OrderinOptionInterface $option): void;

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
     * @return OrderinOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
