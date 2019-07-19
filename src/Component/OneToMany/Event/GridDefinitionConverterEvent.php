<?php

declare(strict_types=1);

namespace Component\OneToMany\Event;

use Component\OneToMany\Definition\OneToMany;
use Symfony\Component\EventDispatcher\Event;

final class OneToManyDefinitionConverterEvent extends Event
{
    /**
     * @var OneToMany
     */
    private $grid;

    /**
     * @param OneToMany $grid
     */
    public function __construct(OneToMany $grid)
    {
        $this->grid = $grid;
    }

    /**
     * @return OneToMany
     */
    public function getOneToMany(): OneToMany
    {
        return $this->grid;
    }
}
