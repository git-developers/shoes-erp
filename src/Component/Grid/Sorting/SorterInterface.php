<?php

declare(strict_types=1);

namespace Component\Grid\Sorting;

use Component\Grid\Data\DataSourceInterface;
use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;

interface SorterInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param Grid $grid
     * @param Parameters $parameters
     */
    public function sort(DataSourceInterface $dataSource, Grid $grid, Parameters $parameters): void;
}
