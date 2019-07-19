<?php

declare(strict_types=1);

namespace Component\OneToMany\Filtering;

use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

interface FiltersCriteriaResolverInterface
{
    /**
     * @param OneToMany $grid
     * @param Parameters $parameters
     *
     * @return bool
     */
    public function hasCriteria(OneToMany $grid, Parameters $parameters): bool;

    /**
     * @param OneToMany $grid
     * @param Parameters $parameters
     *
     * @return array
     */
    public function getCriteria(OneToMany $grid, Parameters $parameters): array;
}
