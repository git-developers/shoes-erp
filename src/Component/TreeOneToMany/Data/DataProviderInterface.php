<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Data;

use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;

interface DataProviderInterface
{
    /**
     * @param TreeOneToMany $grid
     * @param Parameters $parameters
     *
     * @return mixed
     */
    public function getData(TreeOneToMany $grid, Parameters $parameters);
}
