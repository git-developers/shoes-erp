<?php

declare(strict_types=1);

namespace Component\Profile\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface ProfileAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return ProfileAssociationTypeInterface|null
     */
    public function getType(): ?ProfileAssociationTypeInterface;

    /**
     * @param ProfileAssociationTypeInterface|null $type
     */
    public function setType(?ProfileAssociationTypeInterface $type): void;

    /**
     * @return ProfileInterface|null
     */
    public function getOwner(): ?ProfileInterface;

    /**
     * @param ProfileInterface|null $owner
     */
    public function setOwner(?ProfileInterface $owner): void;

    /**
     * @return Collection|ProfileInterface[]
     */
    public function getAssociatedProfiles(): Collection;

    /**
     * @param ProfileInterface $Profile
     */
    public function addAssociatedProfile(ProfileInterface $Profile): void;

    /**
     * @param ProfileInterface $Profile
     */
    public function removeAssociatedProfile(ProfileInterface $Profile): void;

    /**
     * @param ProfileInterface $Profile
     *
     * @return bool
     */
    public function hasAssociatedProfile(ProfileInterface $Profile): bool;

    public function clearAssociatedProfiles(): void;
}
