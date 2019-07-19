<?php

declare(strict_types=1);

namespace Component\User\Security\Generator;

interface GeneratorInterface
{
    /**
     * @return string
     */
    public function generate(): string;
}
