<?php

declare(strict_types=1);

namespace Component\Ticket\Repository;

use Component\Ticket\Model\TicketInterface;
use Component\Core\Repository\RepositoryInterface;

interface TicketRepositoryInterface extends RepositoryInterface
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
     * @return array|TicketInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|TicketInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
