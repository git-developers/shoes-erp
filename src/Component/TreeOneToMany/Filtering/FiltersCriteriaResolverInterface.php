<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Filtering;

use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;

interface FiltersCriteriaResolverInterface
{
    /**
     * @param TreeOneToMany $grid
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function hasCriteria(TreeOneToMany $grid, Parameters $parameters): bool;

    /**
     * @param TreeOneToMany $grid
     * @param Parameters $parameters
     *
     * @return array
     */
    public function getCriteria(TreeOneToMany $grid, Parameters $parameters): array;
}
