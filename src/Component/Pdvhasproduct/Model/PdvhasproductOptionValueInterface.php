<?php

declare(strict_types=1);

namespace Component\Pdvhasproduct\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface PdvhasproductOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return PdvhasproductOptionInterface
     */
    public function getOption(): ?PdvhasproductOptionInterface;

    /**
     * @param PdvhasproductOptionInterface $option
     */
    public function setOption(?PdvhasproductOptionInterface $option): void;

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
     * @return PdvhasproductOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
