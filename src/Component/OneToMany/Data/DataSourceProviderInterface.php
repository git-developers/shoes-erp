<?php

declare(strict_types=1);

namespace Component\OneToMany\Data;

use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

interface DataSourceProviderInterface
{
    /**
     * @param OneToMany $grid
     * @param Parameters $parameters
     *
     * @return DataSourceInterface
     */
    public function getDataSource(OneToMany $grid, Parameters $parameters): DataSourceInterface;
}
