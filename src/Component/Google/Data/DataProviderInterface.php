<?php

declare(strict_types=1);

namespace Component\Google\Data;

use Component\Google\Definition\Google;
use Component\Google\Parameters;

interface DataProviderInterface
{
    /**
     * @param Google $grid
     * @param Parameters $parameters
     *
     * @return mixed
     */
    public function getData(Google $grid, Parameters $parameters);
}
