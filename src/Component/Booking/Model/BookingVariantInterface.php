<?php

declare(strict_types=1);

namespace Component\Booking\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface BookingVariantInterface extends
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
     * @return Collection|BookingOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param BookingOptionValueInterface $optionValue
     */
    public function addOptionValue(BookingOptionValueInterface $optionValue): void;

    /**
     * @param BookingOptionValueInterface $optionValue
     */
    public function removeOptionValue(BookingOptionValueInterface $optionValue): void;

    /**
     * @param BookingOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(BookingOptionValueInterface $optionValue): bool;

    /**
     * @return BookingInterface|null
     */
    public function getBooking(): ?BookingInterface;

    /**
     * @param BookingInterface|null $Booking
     */
    public function setBooking(?BookingInterface $Booking): void;

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
     * @return BookingVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
