<?php

declare(strict_types=1);

namespace Component\DUMMY_UPPER\Repository;

use Component\DUMMY_UPPER\Model\DUMMY_UPPERInterface;
use Component\Core\Repository\RepositoryInterface;

interface DUMMY_UPPERRepositoryInterface extends RepositoryInterface
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
     * @return array|DUMMY_UPPERInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|DUMMY_UPPERInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
