<?php

declare(strict_types=1);

namespace Component\Grid\Provider;

use Component\Grid\Definition\Grid;
use Component\Grid\Exception\UndefinedGridException;

interface GridProviderInterface
{
    /**
     * @param string $code
     *
     * @return Grid
     *
     * @throws UndefinedGridException
     */
    public function get(string $code): Grid;
}
