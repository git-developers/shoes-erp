<?php

declare(strict_types=1);

namespace Component\Order\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class OrderinAssociation implements OrderinAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var OrderinAssociationTypeInterface
     */
    protected $type;

    /**
     * @var OrderinInterface
     */
    protected $owner;

    /**
     * @var Collection|OrderinInterface[]
     */
    protected $associatedOrderins;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedOrderins = new ArrayCollection();
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
    public function getType(): ?OrderinAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?OrderinAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?OrderinInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?OrderinInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedOrderins(): Collection
    {
        return $this->associatedOrderins;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedOrderin(OrderinInterface $Orderin): bool
    {
        return $this->associatedOrderins->contains($Orderin);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedOrderin(OrderinInterface $Orderin): void
    {
        if (!$this->hasAssociatedOrderin($Orderin)) {
            $this->associatedOrderins->add($Orderin);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedOrderin(OrderinInterface $Orderin): void
    {
        if ($this->hasAssociatedOrderin($Orderin)) {
            $this->associatedOrderins->removeElement($Orderin);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedOrderins(): void
    {
        $this->associatedOrderins->clear();
    }
}
