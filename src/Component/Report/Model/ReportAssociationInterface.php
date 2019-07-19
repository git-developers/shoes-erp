<?php

declare(strict_types=1);

namespace Component\Report\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface ReportAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return ReportAssociationTypeInterface|null
     */
    public function getType(): ?ReportAssociationTypeInterface;

    /**
     * @param ReportAssociationTypeInterface|null $type
     */
    public function setType(?ReportAssociationTypeInterface $type): void;

    /**
     * @return ReportInterface|null
     */
    public function getOwner(): ?ReportInterface;

    /**
     * @param ReportInterface|null $owner
     */
    public function setOwner(?ReportInterface $owner): void;

    /**
     * @return Collection|ReportInterface[]
     */
    public function getAssociatedReports(): Collection;

    /**
     * @param ReportInterface $Report
     */
    public function addAssociatedReport(ReportInterface $Report): void;

    /**
     * @param ReportInterface $Report
     */
    public function removeAssociatedReport(ReportInterface $Report): void;

    /**
     * @param ReportInterface $Report
     *
     * @return bool
     */
    public function hasAssociatedReport(ReportInterface $Report): bool;

    public function clearAssociatedReports(): void;
}
