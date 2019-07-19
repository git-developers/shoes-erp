<?php

declare(strict_types=1);

namespace Component\Resource\Model;

interface VersionedInterface
{
    /**
     * @return int|null
     */
    public function getVersion(): ?int;

    /**
     * @param int|null $version
     */
    public function setVersion(?int $version): void;
}
