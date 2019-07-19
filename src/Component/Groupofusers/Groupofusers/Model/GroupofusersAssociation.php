<?php

declare(strict_types=1);

namespace Component\Groupofusers\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class GroupofusersAssociation implements GroupofusersAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var GroupofusersAssociationTypeInterface
     */
    protected $type;

    /**
     * @var GroupofusersInterface
     */
    protected $owner;

    /**
     * @var Collection|GroupofusersInterface[]
     */
    protected $associatedGroupofuserss;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedGroupofuserss = new ArrayCollection();
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
    public function getType(): ?GroupofusersAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?GroupofusersAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?GroupofusersInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?GroupofusersInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedGroupofuserss(): Collection
    {
        return $this->associatedGroupofuserss;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedGroupofusers(GroupofusersInterface $Groupofusers): bool
    {
        return $this->associatedGroupofuserss->contains($Groupofusers);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedGroupofusers(GroupofusersInterface $Groupofusers): void
    {
        if (!$this->hasAssociatedGroupofusers($Groupofusers)) {
            $this->associatedGroupofuserss->add($Groupofusers);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedGroupofusers(GroupofusersInterface $Groupofusers): void
    {
        if ($this->hasAssociatedGroupofusers($Groupofusers)) {
            $this->associatedGroupofuserss->removeElement($Groupofusers);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedGroupofuserss(): void
    {
        $this->associatedGroupofuserss->clear();
    }
}
