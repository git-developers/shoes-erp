<?php

declare(strict_types=1);

namespace Component\Route\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface RouteAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return RouteAssociationTypeInterface|null
     */
    public function getType(): ?RouteAssociationTypeInterface;

    /**
     * @param RouteAssociationTypeInterface|null $type
     */
    public function setType(?RouteAssociationTypeInterface $type): void;

    /**
     * @return RouteInterface|null
     */
    public function getOwner(): ?RouteInterface;

    /**
     * @param RouteInterface|null $owner
     */
    public function setOwner(?RouteInterface $owner): void;

    /**
     * @return Collection|RouteInterface[]
     */
    public function getAssociatedRoutes(): Collection;

    /**
     * @param RouteInterface $Route
     */
    public function addAssociatedRoute(RouteInterface $Route): void;

    /**
     * @param RouteInterface $Route
     */
    public function removeAssociatedRoute(RouteInterface $Route): void;

    /**
     * @param RouteInterface $Route
     *
     * @return bool
     */
    public function hasAssociatedRoute(RouteInterface $Route): bool;

    public function clearAssociatedRoutes(): void;
}
