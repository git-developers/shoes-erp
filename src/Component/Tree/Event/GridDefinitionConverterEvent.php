<?php

declare(strict_types=1);

namespace Component\Tree\Event;

use Component\Tree\Definition\Tree;
use Symfony\Component\EventDispatcher\Event;

final class TreeDefinitionConverterEvent extends Event
{
    /**
     * @var Tree
     */
    private $grid;

    /**
     * @param Tree $grid
     */
    public function __construct(Tree $grid)
    {
        $this->grid = $grid;
    }

    /**
     * @return Tree
     */
    public function getTree(): Tree
    {
        return $this->grid;
    }
}
