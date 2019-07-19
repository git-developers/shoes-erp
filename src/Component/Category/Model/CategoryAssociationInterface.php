<?php

declare(strict_types=1);

namespace Component\Category\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface CategoryAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return CategoryAssociationTypeInterface|null
     */
    public function getType(): ?CategoryAssociationTypeInterface;

    /**
     * @param CategoryAssociationTypeInterface|null $type
     */
    public function setType(?CategoryAssociationTypeInterface $type): void;

    /**
     * @return CategoryInterface|null
     */
    public function getOwner(): ?CategoryInterface;

    /**
     * @param CategoryInterface|null $owner
     */
    public function setOwner(?CategoryInterface $owner): void;

    /**
     * @return Collection|CategoryInterface[]
     */
    public function getAssociatedCategorys(): Collection;

    /**
     * @param CategoryInterface $Category
     */
    public function addAssociatedCategory(CategoryInterface $Category): void;

    /**
     * @param CategoryInterface $Category
     */
    public function removeAssociatedCategory(CategoryInterface $Category): void;

    /**
     * @param CategoryInterface $Category
     *
     * @return bool
     */
    public function hasAssociatedCategory(CategoryInterface $Category): bool;

    public function clearAssociatedCategorys(): void;
}
