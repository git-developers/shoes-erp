<?php

declare(strict_types=1);

namespace Component\OneToMany\Data;

use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

interface DataProviderInterface
{
    /**
     * @param OneToMany $grid
     * @param Parameters $parameters
     *
     * @return mixed
     */
    public function getData(OneToMany $grid, Parameters $parameters);
}
