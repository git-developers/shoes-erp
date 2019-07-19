<?php

declare(strict_types=1);

namespace Component\Visit\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface VisitOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return VisitOptionInterface
     */
    public function getOption(): ?VisitOptionInterface;

    /**
     * @param VisitOptionInterface $option
     */
    public function setOption(?VisitOptionInterface $option): void;

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
     * @return VisitOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
