<?php

declare(strict_types=1);

namespace Component\Module\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class ModuleAssociation implements ModuleAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var ModuleAssociationTypeInterface
     */
    protected $type;

    /**
     * @var ModuleInterface
     */
    protected $owner;

    /**
     * @var Collection|ModuleInterface[]
     */
    protected $associatedModules;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedModules = new ArrayCollection();
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
    public function getType(): ?ModuleAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?ModuleAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?ModuleInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?ModuleInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedModules(): Collection
    {
        return $this->associatedModules;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedModule(ModuleInterface $Module): bool
    {
        return $this->associatedModules->contains($Module);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedModule(ModuleInterface $Module): void
    {
        if (!$this->hasAssociatedModule($Module)) {
            $this->associatedModules->add($Module);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedModule(ModuleInterface $Module): void
    {
        if ($this->hasAssociatedModule($Module)) {
            $this->associatedModules->removeElement($Module);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedModules(): void
    {
        $this->associatedModules->clear();
    }
}
