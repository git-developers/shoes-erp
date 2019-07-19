<?php

declare(strict_types=1);

namespace Component\Module\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface ModuleAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return ModuleAssociationTypeInterface|null
     */
    public function getType(): ?ModuleAssociationTypeInterface;

    /**
     * @param ModuleAssociationTypeInterface|null $type
     */
    public function setType(?ModuleAssociationTypeInterface $type): void;

    /**
     * @return ModuleInterface|null
     */
    public function getOwner(): ?ModuleInterface;

    /**
     * @param ModuleInterface|null $owner
     */
    public function setOwner(?ModuleInterface $owner): void;

    /**
     * @return Collection|ModuleInterface[]
     */
    public function getAssociatedModules(): Collection;

    /**
     * @param ModuleInterface $Module
     */
    public function addAssociatedModule(ModuleInterface $Module): void;

    /**
     * @param ModuleInterface $Module
     */
    public function removeAssociatedModule(ModuleInterface $Module): void;

    /**
     * @param ModuleInterface $Module
     *
     * @return bool
     */
    public function hasAssociatedModule(ModuleInterface $Module): bool;

    public function clearAssociatedModules(): void;
}
