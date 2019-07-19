<?php

declare(strict_types=1);

namespace Component\Resource\Model;

interface ArchivableInterface
{
    /**
     * @return \DateTimeInterface|null
     */
    public function getArchivedAt(): ?\DateTimeInterface;

    /**
     * @param \DateTimeInterface|null $archivedAt
     */
    public function setArchivedAt(?\DateTimeInterface $archivedAt): void;
}
