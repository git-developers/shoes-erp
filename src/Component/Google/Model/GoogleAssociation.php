<?php

declare(strict_types=1);

namespace Component\Google\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class GoogleAssociation implements GoogleAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var GoogleAssociationTypeInterface
     */
    protected $type;

    /**
     * @var GoogleInterface
     */
    protected $owner;

    /**
     * @var Collection|GoogleInterface[]
     */
    protected $associatedGoogles;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedGoogles = new ArrayCollection();
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
    public function getType(): ?GoogleAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?GoogleAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?GoogleInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?GoogleInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedGoogles(): Collection
    {
        return $this->associatedGoogles;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedGoogle(GoogleInterface $Google): bool
    {
        return $this->associatedGoogles->contains($Google);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedGoogle(GoogleInterface $Google): void
    {
        if (!$this->hasAssociatedGoogle($Google)) {
            $this->associatedGoogles->add($Google);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedGoogle(GoogleInterface $Google): void
    {
        if ($this->hasAssociatedGoogle($Google)) {
            $this->associatedGoogles->removeElement($Google);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedGoogles(): void
    {
        $this->associatedGoogles->clear();
    }
}
