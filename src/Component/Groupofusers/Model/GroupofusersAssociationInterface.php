<?php

declare(strict_types=1);

namespace Component\Groupofusers\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface GroupofusersAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return GroupofusersAssociationTypeInterface|null
     */
    public function getType(): ?GroupofusersAssociationTypeInterface;

    /**
     * @param GroupofusersAssociationTypeInterface|null $type
     */
    public function setType(?GroupofusersAssociationTypeInterface $type): void;

    /**
     * @return GroupofusersInterface|null
     */
    public function getOwner(): ?GroupofusersInterface;

    /**
     * @param GroupofusersInterface|null $owner
     */
    public function setOwner(?GroupofusersInterface $owner): void;

    /**
     * @return Collection|GroupofusersInterface[]
     */
    public function getAssociatedGroupofuserss(): Collection;

    /**
     * @param GroupofusersInterface $Groupofusers
     */
    public function addAssociatedGroupofusers(GroupofusersInterface $Groupofusers): void;

    /**
     * @param GroupofusersInterface $Groupofusers
     */
    public function removeAssociatedGroupofusers(GroupofusersInterface $Groupofusers): void;

    /**
     * @param GroupofusersInterface $Groupofusers
     *
     * @return bool
     */
    public function hasAssociatedGroupofusers(GroupofusersInterface $Groupofusers): bool;

    public function clearAssociatedGroupofuserss(): void;
}
