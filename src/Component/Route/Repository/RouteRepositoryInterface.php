<?php

declare(strict_types=1);

namespace Component\Route\Repository;

use Component\Route\Model\RouteInterface;
use Component\Core\Repository\RepositoryInterface;

interface RouteRepositoryInterface extends RepositoryInterface
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
     * @return array|RouteInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|RouteInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
