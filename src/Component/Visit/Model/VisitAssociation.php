<?php

declare(strict_types=1);

namespace Component\Visit\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class VisitAssociation implements VisitAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var VisitAssociationTypeInterface
     */
    protected $type;

    /**
     * @var VisitInterface
     */
    protected $owner;

    /**
     * @var Collection|VisitInterface[]
     */
    protected $associatedVisits;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedVisits = new ArrayCollection();
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
    public function getType(): ?VisitAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?VisitAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?VisitInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?VisitInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedVisits(): Collection
    {
        return $this->associatedVisits;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedVisit(VisitInterface $Visit): bool
    {
        return $this->associatedVisits->contains($Visit);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedVisit(VisitInterface $Visit): void
    {
        if (!$this->hasAssociatedVisit($Visit)) {
            $this->associatedVisits->add($Visit);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedVisit(VisitInterface $Visit): void
    {
        if ($this->hasAssociatedVisit($Visit)) {
            $this->associatedVisits->removeElement($Visit);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedVisits(): void
    {
        $this->associatedVisits->clear();
    }
}
