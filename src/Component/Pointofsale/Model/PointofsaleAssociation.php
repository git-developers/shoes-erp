<?php

declare(strict_types=1);

namespace Component\Pointofsale\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class PointofsaleAssociation implements PointofsaleAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var PointofsaleAssociationTypeInterface
     */
    protected $type;

    /**
     * @var PointofsaleInterface
     */
    protected $owner;

    /**
     * @var Collection|PointofsaleInterface[]
     */
    protected $associatedPointofsales;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedPointofsales = new ArrayCollection();
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
    public function getType(): ?PointofsaleAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?PointofsaleAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?PointofsaleInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?PointofsaleInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedPointofsales(): Collection
    {
        return $this->associatedPointofsales;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedPointofsale(PointofsaleInterface $Pointofsale): bool
    {
        return $this->associatedPointofsales->contains($Pointofsale);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedPointofsale(PointofsaleInterface $Pointofsale): void
    {
        if (!$this->hasAssociatedPointofsale($Pointofsale)) {
            $this->associatedPointofsales->add($Pointofsale);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedPointofsale(PointofsaleInterface $Pointofsale): void
    {
        if ($this->hasAssociatedPointofsale($Pointofsale)) {
            $this->associatedPointofsales->removeElement($Pointofsale);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedPointofsales(): void
    {
        $this->associatedPointofsales->clear();
    }
}
