<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Repository;

use Component\Core\Repository\RepositoryInterface;

interface TreeOneToManyLeftRepositoryInterface extends RepositoryInterface
{
    public function find($id);
    public function deleteAssociativeTableLeft($id): bool;
//    public function searchBoxLeft($q, $offset = 0, $limit = 50): array;
    public function findAllOffsetLimit($offset = 0, $limit = 50): array;
}
