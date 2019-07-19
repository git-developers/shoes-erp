<?php

declare(strict_types=1);

namespace Component\Booking\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface BookingAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return BookingAssociationTypeInterface|null
     */
    public function getType(): ?BookingAssociationTypeInterface;

    /**
     * @param BookingAssociationTypeInterface|null $type
     */
    public function setType(?BookingAssociationTypeInterface $type): void;

    /**
     * @return BookingInterface|null
     */
    public function getOwner(): ?BookingInterface;

    /**
     * @param BookingInterface|null $owner
     */
    public function setOwner(?BookingInterface $owner): void;

    /**
     * @return Collection|BookingInterface[]
     */
    public function getAssociatedBookings(): Collection;

    /**
     * @param BookingInterface $Booking
     */
    public function addAssociatedBooking(BookingInterface $Booking): void;

    /**
     * @param BookingInterface $Booking
     */
    public function removeAssociatedBooking(BookingInterface $Booking): void;

    /**
     * @param BookingInterface $Booking
     *
     * @return bool
     */
    public function hasAssociatedBooking(BookingInterface $Booking): bool;

    public function clearAssociatedBookings(): void;
}
