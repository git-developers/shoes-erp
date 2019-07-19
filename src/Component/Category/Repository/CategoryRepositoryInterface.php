<?php

declare(strict_types=1);

namespace Component\Category\Repository;

use Component\Category\Model\CategoryInterface;
use Component\Core\Repository\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{

    public function find($id);
    public function findAll(): array;
    public function findAllParents(): array;
    public function findAllByParent($parent): array;

    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|CategoryInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|CategoryInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
