<?php

declare(strict_types=1);

namespace Component\Product\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface ProductAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return ProductAssociationTypeInterface|null
     */
    public function getType(): ?ProductAssociationTypeInterface;

    /**
     * @param ProductAssociationTypeInterface|null $type
     */
    public function setType(?ProductAssociationTypeInterface $type): void;

    /**
     * @return ProductInterface|null
     */
    public function getOwner(): ?ProductInterface;

    /**
     * @param ProductInterface|null $owner
     */
    public function setOwner(?ProductInterface $owner): void;

    /**
     * @return Collection|ProductInterface[]
     */
    public function getAssociatedProducts(): Collection;

    /**
     * @param ProductInterface $Product
     */
    public function addAssociatedProduct(ProductInterface $Product): void;

    /**
     * @param ProductInterface $Product
     */
    public function removeAssociatedProduct(ProductInterface $Product): void;

    /**
     * @param ProductInterface $Product
     *
     * @return bool
     */
    public function hasAssociatedProduct(ProductInterface $Product): bool;

    public function clearAssociatedProducts(): void;
}
