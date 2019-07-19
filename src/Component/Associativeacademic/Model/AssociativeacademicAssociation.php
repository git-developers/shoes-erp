<?php

declare(strict_types=1);

namespace Component\Associativeacademic\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class AssociativeacademicAssociation implements AssociativeacademicAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var AssociativeacademicAssociationTypeInterface
     */
    protected $type;

    /**
     * @var AssociativeacademicInterface
     */
    protected $owner;

    /**
     * @var Collection|AssociativeacademicInterface[]
     */
    protected $associatedAssociativeacademics;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedAssociativeacademics = new ArrayCollection();
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
    public function getType(): ?AssociativeacademicAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?AssociativeacademicAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?AssociativeacademicInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?AssociativeacademicInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedAssociativeacademics(): Collection
    {
        return $this->associatedAssociativeacademics;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedAssociativeacademic(AssociativeacademicInterface $Associativeacademic): bool
    {
        return $this->associatedAssociativeacademics->contains($Associativeacademic);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedAssociativeacademic(AssociativeacademicInterface $Associativeacademic): void
    {
        if (!$this->hasAssociatedAssociativeacademic($Associativeacademic)) {
            $this->associatedAssociativeacademics->add($Associativeacademic);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedAssociativeacademic(AssociativeacademicInterface $Associativeacademic): void
    {
        if ($this->hasAssociatedAssociativeacademic($Associativeacademic)) {
            $this->associatedAssociativeacademics->removeElement($Associativeacademic);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedAssociativeacademics(): void
    {
        $this->associatedAssociativeacademics->clear();
    }
}
