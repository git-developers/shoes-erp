<?php

declare(strict_types=1);

namespace Component\Associativeacademic\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface AssociativeacademicAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return AssociativeacademicAssociationTypeInterface|null
     */
    public function getType(): ?AssociativeacademicAssociationTypeInterface;

    /**
     * @param AssociativeacademicAssociationTypeInterface|null $type
     */
    public function setType(?AssociativeacademicAssociationTypeInterface $type): void;

    /**
     * @return AssociativeacademicInterface|null
     */
    public function getOwner(): ?AssociativeacademicInterface;

    /**
     * @param AssociativeacademicInterface|null $owner
     */
    public function setOwner(?AssociativeacademicInterface $owner): void;

    /**
     * @return Collection|AssociativeacademicInterface[]
     */
    public function getAssociatedAssociativeacademics(): Collection;

    /**
     * @param AssociativeacademicInterface $Associativeacademic
     */
    public function addAssociatedAssociativeacademic(AssociativeacademicInterface $Associativeacademic): void;

    /**
     * @param AssociativeacademicInterface $Associativeacademic
     */
    public function removeAssociatedAssociativeacademic(AssociativeacademicInterface $Associativeacademic): void;

    /**
     * @param AssociativeacademicInterface $Associativeacademic
     *
     * @return bool
     */
    public function hasAssociatedAssociativeacademic(AssociativeacademicInterface $Associativeacademic): bool;

    public function clearAssociatedAssociativeacademics(): void;
}
