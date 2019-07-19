<?php

declare(strict_types=1);

namespace Component\Grid\Exception;

class UndefinedGridException extends \InvalidArgumentException
{
    /**
     * @param string $code
     */
    public function __construct($code)
    {
        parent::__construct(sprintf('Grid "%s" does not exist.', $code));
    }
}
