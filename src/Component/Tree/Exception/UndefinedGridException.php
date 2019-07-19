<?php

declare(strict_types=1);

namespace Component\Tree\Exception;

class UndefinedTreeException extends \InvalidArgumentException
{
    /**
     * @param string $code
     */
    public function __construct($code)
    {
        parent::__construct(sprintf('Tree "%s" does not exist.', $code));
    }
}
