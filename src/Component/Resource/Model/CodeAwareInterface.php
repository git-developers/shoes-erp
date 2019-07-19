<?php

declare(strict_types=1);

namespace Component\Resource\Model;

interface CodeAwareInterface
{
    /**
     * @return string|null
     */
    public function getCode(): ?string;

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void;
}
