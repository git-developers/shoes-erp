<?php

declare(strict_types=1);

namespace Component\Tree\Provider;

use Component\Tree\Definition\Tree;
use Component\Tree\Exception\UndefinedTreeException;

interface TreeProviderInterface
{
    /**
     * @param string $code
     *
     * @return Tree
     *
     * @throws UndefinedTreeException
     */
    public function get(string $code): Tree;
}
