<?php

declare(strict_types=1);

namespace Component\Visit\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface VisitAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return VisitAssociationTypeInterface|null
     */
    public function getType(): ?VisitAssociationTypeInterface;

    /**
     * @param VisitAssociationTypeInterface|null $type
     */
    public function setType(?VisitAssociationTypeInterface $type): void;

    /**
     * @return VisitInterface|null
     */
    public function getOwner(): ?VisitInterface;

    /**
     * @param VisitInterface|null $owner
     */
    public function setOwner(?VisitInterface $owner): void;

    /**
     * @return Collection|VisitInterface[]
     */
    public function getAssociatedVisits(): Collection;

    /**
     * @param VisitInterface $Visit
     */
    public function addAssociatedVisit(VisitInterface $Visit): void;

    /**
     * @param VisitInterface $Visit
     */
    public function removeAssociatedVisit(VisitInterface $Visit): void;

    /**
     * @param VisitInterface $Visit
     *
     * @return bool
     */
    public function hasAssociatedVisit(VisitInterface $Visit): bool;

    public function clearAssociatedVisits(): void;
}
