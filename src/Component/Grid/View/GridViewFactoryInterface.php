<?php

declare(strict_types=1);

namespace Component\Grid\View;

use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;

interface GridViewFactoryInterface
{
    /**
     * @param Grid $grid
     * @param Parameters $parameters
     *
     * @return GridViewInterface
     */
    public function create(Grid $grid, Parameters $parameters): GridViewInterface;
}
