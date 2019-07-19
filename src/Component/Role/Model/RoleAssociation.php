<?php

declare(strict_types=1);

namespace Component\Role\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class RoleAssociation implements RoleAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var RoleAssociationTypeInterface
     */
    protected $type;

    /**
     * @var RoleInterface
     */
    protected $owner;

    /**
     * @var Collection|RoleInterface[]
     */
    protected $associatedRoles;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedRoles = new ArrayCollection();
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
    public function getType(): ?RoleAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?RoleAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?RoleInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?RoleInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedRoles(): Collection
    {
        return $this->associatedRoles;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedRole(RoleInterface $Role): bool
    {
        return $this->associatedRoles->contains($Role);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedRole(RoleInterface $Role): void
    {
        if (!$this->hasAssociatedRole($Role)) {
            $this->associatedRoles->add($Role);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedRole(RoleInterface $Role): void
    {
        if ($this->hasAssociatedRole($Role)) {
            $this->associatedRoles->removeElement($Role);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedRoles(): void
    {
        $this->associatedRoles->clear();
    }
}
