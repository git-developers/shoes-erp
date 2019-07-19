<?php

declare(strict_types=1);

namespace Component\Profile\Repository;

use Component\Profile\Model\ProfileInterface;
use Component\Core\Repository\RepositoryInterface;

interface ProfileRepositoryInterface extends RepositoryInterface
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
     * @return array|ProfileInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|ProfileInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
