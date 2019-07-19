<?php

declare(strict_types=1);

namespace Component\Order\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface OrderinAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return OrderinAssociationTypeInterface|null
     */
    public function getType(): ?OrderinAssociationTypeInterface;

    /**
     * @param OrderinAssociationTypeInterface|null $type
     */
    public function setType(?OrderinAssociationTypeInterface $type): void;

    /**
     * @return OrderinInterface|null
     */
    public function getOwner(): ?OrderinInterface;

    /**
     * @param OrderinInterface|null $owner
     */
    public function setOwner(?OrderinInterface $owner): void;

    /**
     * @return Collection|OrderinInterface[]
     */
    public function getAssociatedOrderins(): Collection;

    /**
     * @param OrderinInterface $Orderin
     */
    public function addAssociatedOrderin(OrderinInterface $Orderin): void;

    /**
     * @param OrderinInterface $Orderin
     */
    public function removeAssociatedOrderin(OrderinInterface $Orderin): void;

    /**
     * @param OrderinInterface $Orderin
     *
     * @return bool
     */
    public function hasAssociatedOrderin(OrderinInterface $Orderin): bool;

    public function clearAssociatedOrderins(): void;
}
