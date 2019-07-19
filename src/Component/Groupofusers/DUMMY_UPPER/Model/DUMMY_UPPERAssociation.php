<?php

declare(strict_types=1);

namespace Component\DUMMY_UPPER\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class DUMMY_UPPERAssociation implements DUMMY_UPPERAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var DUMMY_UPPERAssociationTypeInterface
     */
    protected $type;

    /**
     * @var DUMMY_UPPERInterface
     */
    protected $owner;

    /**
     * @var Collection|DUMMY_UPPERInterface[]
     */
    protected $associatedDUMMY_UPPERs;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedDUMMY_UPPERs = new ArrayCollection();
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
    public function getType(): ?DUMMY_UPPERAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?DUMMY_UPPERAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?DUMMY_UPPERInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?DUMMY_UPPERInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedDUMMY_UPPERs(): Collection
    {
        return $this->associatedDUMMY_UPPERs;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedDUMMY_UPPER(DUMMY_UPPERInterface $DUMMY_UPPER): bool
    {
        return $this->associatedDUMMY_UPPERs->contains($DUMMY_UPPER);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedDUMMY_UPPER(DUMMY_UPPERInterface $DUMMY_UPPER): void
    {
        if (!$this->hasAssociatedDUMMY_UPPER($DUMMY_UPPER)) {
            $this->associatedDUMMY_UPPERs->add($DUMMY_UPPER);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedDUMMY_UPPER(DUMMY_UPPERInterface $DUMMY_UPPER): void
    {
        if ($this->hasAssociatedDUMMY_UPPER($DUMMY_UPPER)) {
            $this->associatedDUMMY_UPPERs->removeElement($DUMMY_UPPER);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedDUMMY_UPPERs(): void
    {
        $this->associatedDUMMY_UPPERs->clear();
    }
}
