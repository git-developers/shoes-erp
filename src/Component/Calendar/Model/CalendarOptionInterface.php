<?php

declare(strict_types=1);

namespace Component\Calendar\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface CalendarOptionInterface extends
    ResourceInterface,
    CodeAwareInterface,
    TimestampableInterface,
    TranslatableInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;

    /**
     * @return int
     */
    public function getPosition(): ?int;

    /**
     * @param int $position
     */
    public function setPosition(?int $position): void;

    /**
     * @return Collection|CalendarOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param CalendarOptionValueInterface $optionValue
     */
    public function addValue(CalendarOptionValueInterface $optionValue): void;

    /**
     * @param CalendarOptionValueInterface $optionValue
     */
    public function removeValue(CalendarOptionValueInterface $optionValue): void;

    /**
     * @param CalendarOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(CalendarOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return CalendarOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
