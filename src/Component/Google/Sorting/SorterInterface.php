<?php

declare(strict_types=1);

namespace Component\Google\Sorting;

use Component\Google\Data\DataSourceInterface;
use Component\Google\Definition\Google;
use Component\Google\Parameters;

interface SorterInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param Google $grid
     * @param Parameters $parameters
     */
    public function sort(DataSourceInterface $dataSource, Google $grid, Parameters $parameters): void;
}
