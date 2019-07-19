<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Event;

use Component\TreeOneToMany\Definition\TreeOneToMany;
use Symfony\Component\EventDispatcher\Event;

final class TreeOneToManyDefinitionConverterEvent extends Event
{
    /**
     * @var TreeOneToMany
     */
    private $grid;

    /**
     * @param TreeOneToMany $grid
     */
    public function __construct(TreeOneToMany $grid)
    {
        $this->grid = $grid;
    }

    /**
     * @return TreeOneToMany
     */
    public function getTreeOneToMany(): TreeOneToMany
    {
        return $this->grid;
    }
}
