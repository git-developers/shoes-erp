<?php

declare(strict_types=1);

namespace Component\Role\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface RoleAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return RoleAssociationTypeInterface|null
     */
    public function getType(): ?RoleAssociationTypeInterface;

    /**
     * @param RoleAssociationTypeInterface|null $type
     */
    public function setType(?RoleAssociationTypeInterface $type): void;

    /**
     * @return RoleInterface|null
     */
    public function getOwner(): ?RoleInterface;

    /**
     * @param RoleInterface|null $owner
     */
    public function setOwner(?RoleInterface $owner): void;

    /**
     * @return Collection|RoleInterface[]
     */
    public function getAssociatedRoles(): Collection;

    /**
     * @param RoleInterface $Role
     */
    public function addAssociatedRole(RoleInterface $Role): void;

    /**
     * @param RoleInterface $Role
     */
    public function removeAssociatedRole(RoleInterface $Role): void;

    /**
     * @param RoleInterface $Role
     *
     * @return bool
     */
    public function hasAssociatedRole(RoleInterface $Role): bool;

    public function clearAssociatedRoles(): void;
}
