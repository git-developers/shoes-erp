<?php

declare(strict_types=1);

namespace Component\Product\Repository;

use Component\Product\Model\ProductInterface;
use Component\Core\Repository\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
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
     * @return array|ProductInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|ProductInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
