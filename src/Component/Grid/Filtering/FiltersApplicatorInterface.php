<?php

declare(strict_types=1);

namespace Component\Grid\Filtering;

use Component\Grid\Data\DataSourceInterface;
use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;

interface FiltersApplicatorInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param Grid $grid
     * @param Parameters $parameters
     */
    public function apply(DataSourceInterface $dataSource, Grid $grid, Parameters $parameters): void;
}
