<?php

declare(strict_types=1);

namespace Component\Files\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class FilesAssociation implements FilesAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var FilesAssociationTypeInterface
     */
    protected $type;

    /**
     * @var FilesInterface
     */
    protected $owner;

    /**
     * @var Collection|FilesInterface[]
     */
    protected $associatedFiless;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedFiless = new ArrayCollection();
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
    public function getType(): ?FilesAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?FilesAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?FilesInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?FilesInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedFiless(): Collection
    {
        return $this->associatedFiless;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedFiles(FilesInterface $Files): bool
    {
        return $this->associatedFiless->contains($Files);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedFiles(FilesInterface $Files): void
    {
        if (!$this->hasAssociatedFiles($Files)) {
            $this->associatedFiless->add($Files);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedFiles(FilesInterface $Files): void
    {
        if ($this->hasAssociatedFiles($Files)) {
            $this->associatedFiless->removeElement($Files);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedFiless(): void
    {
        $this->associatedFiless->clear();
    }
}
