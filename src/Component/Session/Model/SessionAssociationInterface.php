<?php

declare(strict_types=1);

namespace Component\Session\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface SessionAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return SessionAssociationTypeInterface|null
     */
    public function getType(): ?SessionAssociationTypeInterface;

    /**
     * @param SessionAssociationTypeInterface|null $type
     */
    public function setType(?SessionAssociationTypeInterface $type): void;

    /**
     * @return SessionInterface|null
     */
    public function getOwner(): ?SessionInterface;

    /**
     * @param SessionInterface|null $owner
     */
    public function setOwner(?SessionInterface $owner): void;

    /**
     * @return Collection|SessionInterface[]
     */
    public function getAssociatedSessions(): Collection;

    /**
     * @param SessionInterface $Session
     */
    public function addAssociatedSession(SessionInterface $Session): void;

    /**
     * @param SessionInterface $Session
     */
    public function removeAssociatedSession(SessionInterface $Session): void;

    /**
     * @param SessionInterface $Session
     *
     * @return bool
     */
    public function hasAssociatedSession(SessionInterface $Session): bool;

    public function clearAssociatedSessions(): void;
}
