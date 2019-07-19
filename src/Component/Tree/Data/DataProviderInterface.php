<?php

declare(strict_types=1);

namespace Component\Tree\Data;

use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;

interface DataProviderInterface
{
    /**
     * @param Tree $grid
     * @param Parameters $parameters
     *
     * @return mixed
     */
    public function getData(Tree $grid, Parameters $parameters);
}
