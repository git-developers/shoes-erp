<?php

declare(strict_types=1);

namespace Component\Report\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ReportOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return ReportOptionInterface
     */
    public function getOption(): ?ReportOptionInterface;

    /**
     * @param ReportOptionInterface $option
     */
    public function setOption(?ReportOptionInterface $option): void;

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
     * @return ReportOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
