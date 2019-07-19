<?php

declare(strict_types=1);

namespace Component\Associativeacademic\Repository;

use Component\Associativeacademic\Model\AssociativeacademicInterface;
use Component\Core\Repository\RepositoryInterface;

interface AssociativeacademicRepositoryInterface extends RepositoryInterface
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
     * @return array|AssociativeacademicInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|AssociativeacademicInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
