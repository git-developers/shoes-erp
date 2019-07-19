<?php

declare(strict_types=1);

namespace Component\Services\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class ServicesAssociation implements ServicesAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var ServicesAssociationTypeInterface
     */
    protected $type;

    /**
     * @var ServicesInterface
     */
    protected $owner;

    /**
     * @var Collection|ServicesInterface[]
     */
    protected $associatedServicess;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedServicess = new ArrayCollection();
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
    public function getType(): ?ServicesAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?ServicesAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?ServicesInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?ServicesInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedServicess(): Collection
    {
        return $this->associatedServicess;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedServices(ServicesInterface $Services): bool
    {
        return $this->associatedServicess->contains($Services);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedServices(ServicesInterface $Services): void
    {
        if (!$this->hasAssociatedServices($Services)) {
            $this->associatedServicess->add($Services);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedServices(ServicesInterface $Services): void
    {
        if ($this->hasAssociatedServices($Services)) {
            $this->associatedServicess->removeElement($Services);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedServicess(): void
    {
        $this->associatedServicess->clear();
    }
}
