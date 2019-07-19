<?php

declare(strict_types=1);

namespace Component\User\Repository;

use Component\Resource\Repository\RepositoryInterface;
use Component\User\Model\UserInterface;

interface UserRepositoryInterface extends RepositoryInterface
{

    public function findAll(): array;

    /**
     * @param string $email
     *
     * @return UserInterface|null
     */
    public function findOneByEmail(string $email);
}
