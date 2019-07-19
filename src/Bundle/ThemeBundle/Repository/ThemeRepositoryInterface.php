<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Repository;

use Bundle\ThemeBundle\Model\ThemeInterface;

interface ThemeRepositoryInterface
{
    /**
     * @return array|ThemeInterface[]
     */
    public function findAll(): array;

    /**
     * @param string $name
     *
     * @return ThemeInterface|null
     */
    public function findOneByName(string $name): ?ThemeInterface;

    /**
     * @param string $title
     *
     * @return ThemeInterface|null
     */
    public function findOneByTitle(string $title): ?ThemeInterface;
}
