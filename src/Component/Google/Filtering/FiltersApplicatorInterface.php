<?php

declare(strict_types=1);

namespace Component\Google\Filtering;

use Component\Google\Data\DataSourceInterface;
use Component\Google\Definition\Google;
use Component\Google\Parameters;

interface FiltersApplicatorInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param Google $grid
     * @param Parameters $parameters
     */
    public function apply(DataSourceInterface $dataSource, Google $grid, Parameters $parameters): void;
}
