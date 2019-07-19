<?php

declare(strict_types=1);

namespace Component\Google\Data;

use Component\Google\Definition\Google;
use Component\Google\Parameters;

interface DataSourceProviderInterface
{
    /**
     * @param Google $grid
     * @param Parameters $parameters
     *
     * @return DataSourceInterface
     */
    public function getDataSource(Google $grid, Parameters $parameters): DataSourceInterface;
}
