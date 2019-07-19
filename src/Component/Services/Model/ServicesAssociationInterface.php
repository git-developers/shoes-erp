<?php

declare(strict_types=1);

namespace Component\Services\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface ServicesAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return ServicesAssociationTypeInterface|null
     */
    public function getType(): ?ServicesAssociationTypeInterface;

    /**
     * @param ServicesAssociationTypeInterface|null $type
     */
    public function setType(?ServicesAssociationTypeInterface $type): void;

    /**
     * @return ServicesInterface|null
     */
    public function getOwner(): ?ServicesInterface;

    /**
     * @param ServicesInterface|null $owner
     */
    public function setOwner(?ServicesInterface $owner): void;

    /**
     * @return Collection|ServicesInterface[]
     */
    public function getAssociatedServicess(): Collection;

    /**
     * @param ServicesInterface $Services
     */
    public function addAssociatedServices(ServicesInterface $Services): void;

    /**
     * @param ServicesInterface $Services
     */
    public function removeAssociatedServices(ServicesInterface $Services): void;

    /**
     * @param ServicesInterface $Services
     *
     * @return bool
     */
    public function hasAssociatedServices(ServicesInterface $Services): bool;

    public function clearAssociatedServicess(): void;
}
