<?php

declare(strict_types=1);

namespace Component\User\Security;

use Component\User\Model\CredentialsHolderInterface;

interface PasswordUpdaterInterface
{
    public function updatePassword(CredentialsHolderInterface $user): void;
}
