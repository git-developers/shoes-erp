<?php

declare(strict_types=1);

namespace Component\Session\Repository;

use Component\Session\Model\SessionInterface;
use Component\Core\Repository\RepositoryInterface;

interface SessionRepositoryInterface extends RepositoryInterface
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
     * @return array|SessionInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|SessionInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
