<?php

declare(strict_types=1);

namespace Component\User\Event;

use Component\User\Definition\Grid;
use Symfony\Component\EventDispatcher\Event;

final class UserDefinitionConverterEvent extends Event
{
    /**
     * @var Grid
     */
    private $grid;

    /**
     * @param Grid $grid
     */
    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }

    /**
     * @return Grid
     */
    public function getGrid(): Grid
    {
        return $this->grid;
    }
}
