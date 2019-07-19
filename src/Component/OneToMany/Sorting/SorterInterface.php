<?php

declare(strict_types=1);

namespace Component\OneToMany\Sorting;

use Component\OneToMany\Data\DataSourceInterface;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

interface SorterInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param OneToMany $grid
     * @param Parameters $parameters
     */
    public function sort(DataSourceInterface $dataSource, OneToMany $grid, Parameters $parameters): void;
}
