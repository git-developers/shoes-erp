<?php

declare(strict_types=1);

namespace Component\User\Security\Checker;

use Component\Resource\Repository\RepositoryInterface;

final class TokenUniquenessChecker implements UniquenessCheckerInterface
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var string
     */
    private $tokenFieldName;

    /**
     * @param RepositoryInterface $repository
     * @param string $tokenFieldName
     */
    public function __construct(RepositoryInterface $repository, string $tokenFieldName)
    {
        $this->repository = $repository;
        $this->tokenFieldName = $tokenFieldName;
    }

    /**
     * {@inheritdoc}
     */
    public function isUnique(string $token): bool
    {
        return null === $this->repository->findOneBy([$this->tokenFieldName => $token]);
    }
}
