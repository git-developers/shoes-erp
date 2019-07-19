<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\View;

use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;

interface TreeOneToManyViewFactoryInterface
{
    /**
     * @param TreeOneToMany $grid
     * @param Parameters $parameters
     *
     * @return TreeOneToManyViewInterface
     */
    public function create(TreeOneToMany $grid, Parameters $parameters): TreeOneToManyViewInterface;
}
