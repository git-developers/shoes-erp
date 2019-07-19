<?php

declare(strict_types=1);

namespace Component\Pdvhasproduct\Repository;

use Component\Pdvhasproduct\Model\PdvhasproductInterface;
use Component\Core\Repository\RepositoryInterface;

interface PdvhasproductRepositoryInterface extends RepositoryInterface
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
     * @return array|PdvhasproductInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|PdvhasproductInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
