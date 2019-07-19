<?php

declare(strict_types=1);

namespace Component\Session\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class SessionAssociation implements SessionAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var SessionAssociationTypeInterface
     */
    protected $type;

    /**
     * @var SessionInterface
     */
    protected $owner;

    /**
     * @var Collection|SessionInterface[]
     */
    protected $associatedSessions;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedSessions = new ArrayCollection();
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
    public function getType(): ?SessionAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?SessionAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?SessionInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?SessionInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedSessions(): Collection
    {
        return $this->associatedSessions;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedSession(SessionInterface $Session): bool
    {
        return $this->associatedSessions->contains($Session);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedSession(SessionInterface $Session): void
    {
        if (!$this->hasAssociatedSession($Session)) {
            $this->associatedSessions->add($Session);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedSession(SessionInterface $Session): void
    {
        if ($this->hasAssociatedSession($Session)) {
            $this->associatedSessions->removeElement($Session);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedSessions(): void
    {
        $this->associatedSessions->clear();
    }
}
