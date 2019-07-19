<?php

declare(strict_types=1);

namespace Component\Product\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class ProductAssociation implements ProductAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var ProductAssociationTypeInterface
     */
    protected $type;

    /**
     * @var ProductInterface
     */
    protected $owner;

    /**
     * @var Collection|ProductInterface[]
     */
    protected $associatedProducts;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedProducts = new ArrayCollection();
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
    public function getType(): ?ProductAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?ProductAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?ProductInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?ProductInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedProducts(): Collection
    {
        return $this->associatedProducts;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedProduct(ProductInterface $Product): bool
    {
        return $this->associatedProducts->contains($Product);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedProduct(ProductInterface $Product): void
    {
        if (!$this->hasAssociatedProduct($Product)) {
            $this->associatedProducts->add($Product);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedProduct(ProductInterface $Product): void
    {
        if ($this->hasAssociatedProduct($Product)) {
            $this->associatedProducts->removeElement($Product);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedProducts(): void
    {
        $this->associatedProducts->clear();
    }
}
