<?php

declare(strict_types=1);

namespace Component\Groupofusers\Repository;

use Component\Groupofusers\Model\GroupofusersInterface;
use Component\Core\Repository\RepositoryInterface;

interface GroupofusersRepositoryInterface extends RepositoryInterface
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
     * @return array|GroupofusersInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|GroupofusersInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
