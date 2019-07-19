<?php

declare(strict_types=1);

namespace Component\Tree\Sorting;

use Component\Tree\Data\DataSourceInterface;
use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;

interface SorterInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param Tree $grid
     * @param Parameters $parameters
     */
    public function sort(DataSourceInterface $dataSource, Tree $grid, Parameters $parameters): void;
}
