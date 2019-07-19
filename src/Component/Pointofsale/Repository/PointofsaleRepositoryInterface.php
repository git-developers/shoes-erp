<?php

declare(strict_types=1);

namespace Component\Pointofsale\Repository;

use Component\Pointofsale\Model\PointofsaleInterface;
use Component\Core\Repository\RepositoryInterface;

interface PointofsaleRepositoryInterface extends RepositoryInterface
{

//    /**
//     * @return array
//     */
//    public function gatazo(): array;

    public function find($id);
    public function findAll(): array;

    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|PointofsaleInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|PointofsaleInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
