<?php

declare(strict_types=1);

namespace Component\Services\Repository;

use Component\Services\Model\ServicesInterface;
use Component\Core\Repository\RepositoryInterface;

interface ServicesRepositoryInterface extends RepositoryInterface
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
     * @return array|ServicesInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|ServicesInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
