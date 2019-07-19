<?php

declare(strict_types=1);

namespace Component\Booking\Repository;

use Component\Booking\Model\BookingInterface;
use Component\Core\Repository\RepositoryInterface;

interface BookingRepositoryInterface extends RepositoryInterface
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
     * @return array|BookingInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|BookingInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
