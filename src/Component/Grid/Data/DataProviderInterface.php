<?php

declare(strict_types=1);

namespace Component\Grid\Data;

use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;

interface DataProviderInterface
{
    /**
     * @param Grid $grid
     * @param Parameters $parameters
     *
     * @return mixed
     */
    public function getData(Grid $grid, Parameters $parameters);
}
