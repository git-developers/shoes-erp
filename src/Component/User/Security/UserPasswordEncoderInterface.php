<?php

declare(strict_types=1);

namespace Component\User\Security;

use Component\User\Model\CredentialsHolderInterface;

interface UserPasswordEncoderInterface
{
    /**
     * @param CredentialsHolderInterface $user
     *
     * @return string
     */
    public function encode(CredentialsHolderInterface $user): string;
}
