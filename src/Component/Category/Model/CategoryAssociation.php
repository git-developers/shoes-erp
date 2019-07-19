<?php

declare(strict_types=1);

namespace Component\Category\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class CategoryAssociation implements CategoryAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var CategoryAssociationTypeInterface
     */
    protected $type;

    /**
     * @var CategoryInterface
     */
    protected $owner;

    /**
     * @var Collection|CategoryInterface[]
     */
    protected $associatedCategorys;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedCategorys = new ArrayCollection();
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
    public function getType(): ?CategoryAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?CategoryAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?CategoryInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?CategoryInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedCategorys(): Collection
    {
        return $this->associatedCategorys;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedCategory(CategoryInterface $Category): bool
    {
        return $this->associatedCategorys->contains($Category);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedCategory(CategoryInterface $Category): void
    {
        if (!$this->hasAssociatedCategory($Category)) {
            $this->associatedCategorys->add($Category);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedCategory(CategoryInterface $Category): void
    {
        if ($this->hasAssociatedCategory($Category)) {
            $this->associatedCategorys->removeElement($Category);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedCategorys(): void
    {
        $this->associatedCategorys->clear();
    }
}
