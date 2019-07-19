<?php

declare(strict_types=1);

namespace Component\Report\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class ReportAssociation implements ReportAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var ReportAssociationTypeInterface
     */
    protected $type;

    /**
     * @var ReportInterface
     */
    protected $owner;

    /**
     * @var Collection|ReportInterface[]
     */
    protected $associatedReports;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedReports = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ?ReportAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?ReportAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?ReportInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?ReportInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedReports(): Collection
    {
        return $this->associatedReports;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedReport(ReportInterface $Report): bool
    {
        return $this->associatedReports->contains($Report);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedReport(ReportInterface $Report): void
    {
        if (!$this->hasAssociatedReport($Report)) {
            $this->associatedReports->add($Report);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedReport(ReportInterface $Report): void
    {
        if ($this->hasAssociatedReport($Report)) {
            $this->associatedReports->removeElement($Report);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedReports(): void
    {
        $this->associatedReports->clear();
    }
}
