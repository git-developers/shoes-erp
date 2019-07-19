<?php

declare(strict_types=1);

namespace Component\Order\Repository;

use Component\Order\Model\OrderinInterface;
use Component\Core\Repository\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
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
     * @return array|OrderinInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|OrderinInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
