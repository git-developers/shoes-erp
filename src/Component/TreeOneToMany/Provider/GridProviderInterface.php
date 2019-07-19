<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Provider;

use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Exception\UndefinedTreeOneToManyException;

interface TreeOneToManyProviderInterface
{
    /**
     * @param string $code
     *
     * @return TreeOneToMany
     *
     * @throws UndefinedTreeOneToManyException
     */
    public function get(string $code): TreeOneToMany;
}
