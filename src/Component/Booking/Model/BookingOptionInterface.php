<?php

declare(strict_types=1);

namespace Component\Booking\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface BookingOptionInterface extends
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
     * @return Collection|BookingOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param BookingOptionValueInterface $optionValue
     */
    public function addValue(BookingOptionValueInterface $optionValue): void;

    /**
     * @param BookingOptionValueInterface $optionValue
     */
    public function removeValue(BookingOptionValueInterface $optionValue): void;

    /**
     * @param BookingOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(BookingOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return BookingOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
