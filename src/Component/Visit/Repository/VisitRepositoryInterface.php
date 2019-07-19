<?php

declare(strict_types=1);

namespace Component\Visit\Repository;

use Component\Visit\Model\VisitInterface;
use Component\Core\Repository\RepositoryInterface;

interface VisitRepositoryInterface extends RepositoryInterface
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
     * @return array|VisitInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|VisitInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
