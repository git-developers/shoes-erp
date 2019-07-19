<?php

declare(strict_types=1);

namespace Component\OneToMany\View;

use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

interface OneToManyViewFactoryInterface
{
    /**
     * @param OneToMany $grid
     * @param Parameters $parameters
     *
     * @return OneToManyViewInterface
     */
    public function create(OneToMany $grid, Parameters $parameters): OneToManyViewInterface;
}
