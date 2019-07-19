<?php

declare(strict_types=1);

namespace Component\Grid\Filtering;

use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;

interface FiltersCriteriaResolverInterface
{
    /**
     * @param Grid $grid
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function hasCriteria(Grid $grid, Parameters $parameters): bool;

    /**
     * @param Grid $grid
     * @param Parameters $parameters
     *
     * @return array
     */
    public function getCriteria(Grid $grid, Parameters $parameters): array;
}
