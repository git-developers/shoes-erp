<?php

declare(strict_types=1);

namespace Component\OneToMany\Filtering;

use Component\OneToMany\Data\DataSourceInterface;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

interface FiltersApplicatorInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param OneToMany $grid
     * @param Parameters $parameters
     */
    public function apply(DataSourceInterface $dataSource, OneToMany $grid, Parameters $parameters): void;
}
