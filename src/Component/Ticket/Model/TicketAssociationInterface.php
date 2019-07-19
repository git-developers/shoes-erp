<?php

declare(strict_types=1);

namespace Component\Ticket\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface TicketAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return TicketAssociationTypeInterface|null
     */
    public function getType(): ?TicketAssociationTypeInterface;

    /**
     * @param TicketAssociationTypeInterface|null $type
     */
    public function setType(?TicketAssociationTypeInterface $type): void;

    /**
     * @return TicketInterface|null
     */
    public function getOwner(): ?TicketInterface;

    /**
     * @param TicketInterface|null $owner
     */
    public function setOwner(?TicketInterface $owner): void;

    /**
     * @return Collection|TicketInterface[]
     */
    public function getAssociatedTickets(): Collection;

    /**
     * @param TicketInterface $Ticket
     */
    public function addAssociatedTicket(TicketInterface $Ticket): void;

    /**
     * @param TicketInterface $Ticket
     */
    public function removeAssociatedTicket(TicketInterface $Ticket): void;

    /**
     * @param TicketInterface $Ticket
     *
     * @return bool
     */
    public function hasAssociatedTicket(TicketInterface $Ticket): bool;

    public function clearAssociatedTickets(): void;
}
