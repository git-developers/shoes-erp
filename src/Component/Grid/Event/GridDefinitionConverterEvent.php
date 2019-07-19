<?php

declare(strict_types=1);

namespace Component\Grid\Event;

use Component\Grid\Definition\Grid;
use Symfony\Component\EventDispatcher\Event;

final class GridDefinitionConverterEvent extends Event
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
