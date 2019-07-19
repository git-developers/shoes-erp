<?php

declare(strict_types=1);

namespace Component\Module\Repository;

use Component\Module\Model\ModuleInterface;
use Component\Core\Repository\RepositoryInterface;

interface ModuleRepositoryInterface extends RepositoryInterface
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
     * @return array|ModuleInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|ModuleInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
