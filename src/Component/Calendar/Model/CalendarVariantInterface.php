<?php

declare(strict_types=1);

namespace Component\Calendar\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface CalendarVariantInterface extends
    TimestampableInterface,
    ResourceInterface,
    CodeAwareInterface,
    TranslatableInterface
{
    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * @return string
     */
    public function getDescriptor(): string;

    /**
     * @return Collection|CalendarOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param CalendarOptionValueInterface $optionValue
     */
    public function addOptionValue(CalendarOptionValueInterface $optionValue): void;

    /**
     * @param CalendarOptionValueInterface $optionValue
     */
    public function removeOptionValue(CalendarOptionValueInterface $optionValue): void;

    /**
     * @param CalendarOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(CalendarOptionValueInterface $optionValue): bool;

    /**
     * @return CalendarInterface|null
     */
    public function getCalendar(): ?CalendarInterface;

    /**
     * @param CalendarInterface|null $Calendar
     */
    public function setCalendar(?CalendarInterface $Calendar): void;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void;

    /**
     * @param string|null $locale
     *
     * @return CalendarVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
