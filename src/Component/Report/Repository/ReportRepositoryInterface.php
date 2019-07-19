<?php

declare(strict_types=1);

namespace Component\Report\Repository;

use Component\Report\Model\ReportInterface;
use Component\Core\Repository\RepositoryInterface;

interface ReportRepositoryInterface extends RepositoryInterface
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
     * @return array|ReportInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|ReportInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
