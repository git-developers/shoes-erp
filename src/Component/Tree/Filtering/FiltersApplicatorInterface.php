<?php

declare(strict_types=1);

namespace Component\Tree\Filtering;

use Component\Tree\Data\DataSourceInterface;
use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;

interface FiltersApplicatorInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param Tree $grid
     * @param Parameters $parameters
     */
    public function apply(DataSourceInterface $dataSource, Tree $grid, Parameters $parameters): void;
}
