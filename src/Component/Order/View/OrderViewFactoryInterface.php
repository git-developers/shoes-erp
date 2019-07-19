<?php

declare(strict_types=1);

namespace Component\Order\View;

use Component\Order\Definition\Order;
use Component\Order\Parameters;

interface OrderViewFactoryInterface
{
    /**
     * @param Order $grid
     * @param Parameters $parameters
     *
     * @return OneToManyViewInterface
     */
    public function create(Order $grid, Parameters $parameters): OneToManyViewInterface;
}
