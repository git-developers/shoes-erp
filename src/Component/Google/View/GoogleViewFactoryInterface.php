<?php

declare(strict_types=1);

namespace Component\Google\View;

use Component\Google\Definition\Google;
use Component\Google\Parameters;

interface GoogleViewFactoryInterface
{
    /**
     * @param Google $grid
     * @param Parameters $parameters
     *
     * @return GoogleViewInterface
     */
    public function create(Google $grid, Parameters $parameters): GoogleViewInterface;
}
