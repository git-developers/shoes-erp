<?php

declare(strict_types=1);

namespace Component\Profile\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class ProfileAssociation implements ProfileAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var ProfileAssociationTypeInterface
     */
    protected $type;

    /**
     * @var ProfileInterface
     */
    protected $owner;

    /**
     * @var Collection|ProfileInterface[]
     */
    protected $associatedProfiles;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedProfiles = new ArrayCollection();
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
    public function getType(): ?ProfileAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?ProfileAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?ProfileInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?ProfileInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedProfiles(): Collection
    {
        return $this->associatedProfiles;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedProfile(ProfileInterface $Profile): bool
    {
        return $this->associatedProfiles->contains($Profile);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedProfile(ProfileInterface $Profile): void
    {
        if (!$this->hasAssociatedProfile($Profile)) {
            $this->associatedProfiles->add($Profile);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedProfile(ProfileInterface $Profile): void
    {
        if ($this->hasAssociatedProfile($Profile)) {
            $this->associatedProfiles->removeElement($Profile);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedProfiles(): void
    {
        $this->associatedProfiles->clear();
    }
}
