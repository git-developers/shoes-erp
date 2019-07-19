<?php

declare(strict_types=1);

namespace Component\Tree\View;

use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;

interface TreeViewFactoryInterface
{
    /**
     * @param Tree $grid
     * @param Parameters $parameters
     *
     * @return TreeViewInterface
     */
    public function create(Tree $grid, Parameters $parameters): TreeViewInterface;
}
