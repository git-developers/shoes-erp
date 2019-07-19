<?php

declare(strict_types=1);

namespace Component\Booking\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class BookingAssociation implements BookingAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var BookingAssociationTypeInterface
     */
    protected $type;

    /**
     * @var BookingInterface
     */
    protected $owner;

    /**
     * @var Collection|BookingInterface[]
     */
    protected $associatedBookings;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedBookings = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ?BookingAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?BookingAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?BookingInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?BookingInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedBookings(): Collection
    {
        return $this->associatedBookings;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedBooking(BookingInterface $Booking): bool
    {
        return $this->associatedBookings->contains($Booking);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedBooking(BookingInterface $Booking): void
    {
        if (!$this->hasAssociatedBooking($Booking)) {
            $this->associatedBookings->add($Booking);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedBooking(BookingInterface $Booking): void
    {
        if ($this->hasAssociatedBooking($Booking)) {
            $this->associatedBookings->removeElement($Booking);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedBookings(): void
    {
        $this->associatedBookings->clear();
    }
}
