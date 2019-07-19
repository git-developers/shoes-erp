<?php

declare(strict_types=1);

namespace Component\Pointofsale\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface PointofsaleAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return PointofsaleAssociationTypeInterface|null
     */
    public function getType(): ?PointofsaleAssociationTypeInterface;

    /**
     * @param PointofsaleAssociationTypeInterface|null $type
     */
    public function setType(?PointofsaleAssociationTypeInterface $type): void;

    /**
     * @return PointofsaleInterface|null
     */
    public function getOwner(): ?PointofsaleInterface;

    /**
     * @param PointofsaleInterface|null $owner
     */
    public function setOwner(?PointofsaleInterface $owner): void;

    /**
     * @return Collection|PointofsaleInterface[]
     */
    public function getAssociatedPointofsales(): Collection;

    /**
     * @param PointofsaleInterface $Pointofsale
     */
    public function addAssociatedPointofsale(PointofsaleInterface $Pointofsale): void;

    /**
     * @param PointofsaleInterface $Pointofsale
     */
    public function removeAssociatedPointofsale(PointofsaleInterface $Pointofsale): void;

    /**
     * @param PointofsaleInterface $Pointofsale
     *
     * @return bool
     */
    public function hasAssociatedPointofsale(PointofsaleInterface $Pointofsale): bool;

    public function clearAssociatedPointofsales(): void;
}
