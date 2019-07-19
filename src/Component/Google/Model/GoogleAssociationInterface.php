<?php

declare(strict_types=1);

namespace Component\Google\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface GoogleAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return GoogleAssociationTypeInterface|null
     */
    public function getType(): ?GoogleAssociationTypeInterface;

    /**
     * @param GoogleAssociationTypeInterface|null $type
     */
    public function setType(?GoogleAssociationTypeInterface $type): void;

    /**
     * @return GoogleInterface|null
     */
    public function getOwner(): ?GoogleInterface;

    /**
     * @param GoogleInterface|null $owner
     */
    public function setOwner(?GoogleInterface $owner): void;

    /**
     * @return Collection|GoogleInterface[]
     */
    public function getAssociatedGoogles(): Collection;

    /**
     * @param GoogleInterface $Google
     */
    public function addAssociatedGoogle(GoogleInterface $Google): void;

    /**
     * @param GoogleInterface $Google
     */
    public function removeAssociatedGoogle(GoogleInterface $Google): void;

    /**
     * @param GoogleInterface $Google
     *
     * @return bool
     */
    public function hasAssociatedGoogle(GoogleInterface $Google): bool;

    public function clearAssociatedGoogles(): void;
}
