<?php

declare(strict_types=1);

namespace Component\User\Security\Checker;

interface UniquenessCheckerInterface
{
    /**
     * @param string $token
     *
     * @return bool
     */
    public function isUnique(string $token): bool;
}
