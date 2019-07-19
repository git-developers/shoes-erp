<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Filtering;

use Component\TreeOneToMany\Data\DataSourceInterface;
use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;

interface FiltersApplicatorInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param TreeOneToMany $grid
     * @param Parameters $parameters
     */
    public function apply(DataSourceInterface $dataSource, TreeOneToMany $grid, Parameters $parameters): void;
}
