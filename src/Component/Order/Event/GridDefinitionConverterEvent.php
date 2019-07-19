<?php

declare(strict_types=1);

namespace Component\Order\Event;

use Component\Order\Definition\Order;
use Symfony\Component\EventDispatcher\Event;

final class OrderinDefinitionConverterEvent extends Event
{
    /**
     * @var Order
     */
    private $grid;

    /**
     * @param Order $grid
     */
    public function __construct(Order $grid)
    {
        $this->grid = $grid;
    }

    /**
     * @return Order
     */
    public function getOrderin(): Order
    {
        return $this->grid;
    }
}
