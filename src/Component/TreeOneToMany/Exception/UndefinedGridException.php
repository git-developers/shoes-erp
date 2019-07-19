<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Exception;

class UndefinedTreeOneToManyException extends \InvalidArgumentException
{
    /**
     * @param string $code
     */
    public function __construct($code)
    {
        parent::__construct(sprintf('TreeOneToMany "%s" does not exist.', $code));
    }
}
