<?php

declare(strict_types=1);

namespace Component\Resource\Model;

interface SlugAwareInterface
{
    /**
     * @return string|null
     */
    public function getSlug(): ?string;

    /**
     * @param string|null $slug
     */
    public function setSlug(?string $slug): void;
}
