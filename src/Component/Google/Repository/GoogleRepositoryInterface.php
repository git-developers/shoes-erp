<?php

declare(strict_types=1);

namespace Component\Google\Repository;

use Component\Google\Model\GoogleInterface;
use Component\Core\Repository\RepositoryInterface;

interface GoogleRepositoryInterface extends RepositoryInterface
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
     * @return array|GoogleInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|GoogleInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
