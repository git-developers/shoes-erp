<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Sorting;

use Component\TreeOneToMany\Data\DataSourceInterface;
use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;

interface SorterInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param TreeOneToMany $grid
     * @param Parameters $parameters
     */
    public function sort(DataSourceInterface $dataSource, TreeOneToMany $grid, Parameters $parameters): void;
}
