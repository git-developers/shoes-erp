<?php

declare(strict_types=1);

namespace Component\Calendar\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface CalendarAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return CalendarAssociationTypeInterface|null
     */
    public function getType(): ?CalendarAssociationTypeInterface;

    /**
     * @param CalendarAssociationTypeInterface|null $type
     */
    public function setType(?CalendarAssociationTypeInterface $type): void;

    /**
     * @return CalendarInterface|null
     */
    public function getOwner(): ?CalendarInterface;

    /**
     * @param CalendarInterface|null $owner
     */
    public function setOwner(?CalendarInterface $owner): void;

    /**
     * @return Collection|CalendarInterface[]
     */
    public function getAssociatedCalendars(): Collection;

    /**
     * @param CalendarInterface $Calendar
     */
    public function addAssociatedCalendar(CalendarInterface $Calendar): void;

    /**
     * @param CalendarInterface $Calendar
     */
    public function removeAssociatedCalendar(CalendarInterface $Calendar): void;

    /**
     * @param CalendarInterface $Calendar
     *
     * @return bool
     */
    public function hasAssociatedCalendar(CalendarInterface $Calendar): bool;

    public function clearAssociatedCalendars(): void;
}
