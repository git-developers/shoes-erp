<?php

declare(strict_types=1);

namespace Component\Google\Filtering;

use Component\Google\Definition\Google;
use Component\Google\Parameters;

interface FiltersCriteriaResolverInterface
{
    /**
     * @param Google $grid
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function hasCriteria(Google $grid, Parameters $parameters): bool;

    /**
     * @param Google $grid
     * @param Parameters $parameters
     *
     * @return array
     */
    public function getCriteria(Google $grid, Parameters $parameters): array;
}
