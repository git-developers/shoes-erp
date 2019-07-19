<?php

declare(strict_types=1);

namespace Component\Calendar\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class CalendarAssociation implements CalendarAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var CalendarAssociationTypeInterface
     */
    protected $type;

    /**
     * @var CalendarInterface
     */
    protected $owner;

    /**
     * @var Collection|CalendarInterface[]
     */
    protected $associatedCalendars;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedCalendars = new ArrayCollection();
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
    public function getType(): ?CalendarAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?CalendarAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?CalendarInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?CalendarInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCalendars(): Collection
    {
        return $this->associatedCalendars;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedCalendar(CalendarInterface $Calendar): bool
    {
        return $this->associatedCalendars->contains($Calendar);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedCalendar(CalendarInterface $Calendar): void
    {
        if (!$this->hasAssociatedCalendar($Calendar)) {
            $this->associatedCalendars->add($Calendar);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedCalendar(CalendarInterface $Calendar): void
    {
        if ($this->hasAssociatedCalendar($Calendar)) {
            $this->associatedCalendars->removeElement($Calendar);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedCalendars(): void
    {
        $this->associatedCalendars->clear();
    }
}
