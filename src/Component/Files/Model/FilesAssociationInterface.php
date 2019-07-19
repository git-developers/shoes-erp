<?php

declare(strict_types=1);

namespace Component\Files\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface FilesAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return FilesAssociationTypeInterface|null
     */
    public function getType(): ?FilesAssociationTypeInterface;

    /**
     * @param FilesAssociationTypeInterface|null $type
     */
    public function setType(?FilesAssociationTypeInterface $type): void;

    /**
     * @return FilesInterface|null
     */
    public function getOwner(): ?FilesInterface;

    /**
     * @param FilesInterface|null $owner
     */
    public function setOwner(?FilesInterface $owner): void;

    /**
     * @return Collection|FilesInterface[]
     */
    public function getAssociatedFiless(): Collection;

    /**
     * @param FilesInterface $Files
     */
    public function addAssociatedFiles(FilesInterface $Files): void;

    /**
     * @param FilesInterface $Files
     */
    public function removeAssociatedFiles(FilesInterface $Files): void;

    /**
     * @param FilesInterface $Files
     *
     * @return bool
     */
    public function hasAssociatedFiles(FilesInterface $Files): bool;

    public function clearAssociatedFiless(): void;
}
