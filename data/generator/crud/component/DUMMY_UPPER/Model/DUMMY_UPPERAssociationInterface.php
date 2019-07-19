<?php

declare(strict_types=1);

namespace Component\DUMMY_UPPER\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface DUMMY_UPPERAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return DUMMY_UPPERAssociationTypeInterface|null
     */
    public function getType(): ?DUMMY_UPPERAssociationTypeInterface;

    /**
     * @param DUMMY_UPPERAssociationTypeInterface|null $type
     */
    public function setType(?DUMMY_UPPERAssociationTypeInterface $type): void;

    /**
     * @return DUMMY_UPPERInterface|null
     */
    public function getOwner(): ?DUMMY_UPPERInterface;

    /**
     * @param DUMMY_UPPERInterface|null $owner
     */
    public function setOwner(?DUMMY_UPPERInterface $owner): void;

    /**
     * @return Collection|DUMMY_UPPERInterface[]
     */
    public function getAssociatedDUMMY_UPPERs(): Collection;

    /**
     * @param DUMMY_UPPERInterface $DUMMY_UPPER
     */
    public function addAssociatedDUMMY_UPPER(DUMMY_UPPERInterface $DUMMY_UPPER): void;

    /**
     * @param DUMMY_UPPERInterface $DUMMY_UPPER
     */
    public function removeAssociatedDUMMY_UPPER(DUMMY_UPPERInterface $DUMMY_UPPER): void;

    /**
     * @param DUMMY_UPPERInterface $DUMMY_UPPER
     *
     * @return bool
     */
    public function hasAssociatedDUMMY_UPPER(DUMMY_UPPERInterface $DUMMY_UPPER): bool;

    public function clearAssociatedDUMMY_UPPERs(): void;
}
