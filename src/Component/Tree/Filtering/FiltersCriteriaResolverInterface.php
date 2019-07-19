<?php

declare(strict_types=1);

namespace Component\Tree\Filtering;

use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;

interface FiltersCriteriaResolverInterface
{
    /**
     * @param Tree $grid
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function hasCriteria(Tree $grid, Parameters $parameters): bool;

    /**
     * @param Tree $grid
     * @param Parameters $parameters
     *
     * @return array
     */
    public function getCriteria(Tree $grid, Parameters $parameters): array;
}
