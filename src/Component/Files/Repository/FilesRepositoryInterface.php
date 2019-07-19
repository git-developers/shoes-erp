<?php

declare(strict_types=1);

namespace Component\Files\Repository;

use Component\Files\Model\FilesInterface;
use Component\Core\Repository\RepositoryInterface;

interface FilesRepositoryInterface extends RepositoryInterface
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
     * @return array|FilesInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|FilesInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
