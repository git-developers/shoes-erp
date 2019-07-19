<?php

declare(strict_types=1);

namespace Component\Calendar\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface CalendarOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return CalendarOptionInterface
     */
    public function getOption(): ?CalendarOptionInterface;

    /**
     * @param CalendarOptionInterface $option
     */
    public function setOption(?CalendarOptionInterface $option): void;

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
     * @return CalendarOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
