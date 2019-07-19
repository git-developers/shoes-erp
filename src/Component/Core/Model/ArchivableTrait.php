<?php

declare(strict_types=1);

namespace Component\Resource\Model;

/**
 * @see ArchivableInterface
 */
trait ArchivableTrait
{
    /**
     * @var \DateTimeInterface|null
     */
    protected $archivedAt;

    /**
     * @return \DateTimeInterface|null
     */
    public function getArchivedAt(): ?\DateTimeInterface
    {
        return $this->archivedAt;
    }

    /**
     * @param \DateTimeInterface|null $archivedAt
     */
    public function setArchivedAt(?\DateTimeInterface $archivedAt): void
    {
        $this->archivedAt = $archivedAt;
    }
}
