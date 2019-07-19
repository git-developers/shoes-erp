<?php

declare(strict_types=1);

namespace Component\Ticket\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class TicketAssociation implements TicketAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var TicketAssociationTypeInterface
     */
    protected $type;

    /**
     * @var TicketInterface
     */
    protected $owner;

    /**
     * @var Collection|TicketInterface[]
     */
    protected $associatedTickets;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedTickets = new ArrayCollection();
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
    public function getType(): ?TicketAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?TicketAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?TicketInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?TicketInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedTickets(): Collection
    {
        return $this->associatedTickets;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedTicket(TicketInterface $Ticket): bool
    {
        return $this->associatedTickets->contains($Ticket);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedTicket(TicketInterface $Ticket): void
    {
        if (!$this->hasAssociatedTicket($Ticket)) {
            $this->associatedTickets->add($Ticket);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedTicket(TicketInterface $Ticket): void
    {
        if ($this->hasAssociatedTicket($Ticket)) {
            $this->associatedTickets->removeElement($Ticket);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedTickets(): void
    {
        $this->associatedTickets->clear();
    }
}
