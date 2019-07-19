<?php

declare(strict_types=1);

namespace Component\OneToMany\Exception;

class UndefinedOneToManyException extends \InvalidArgumentException
{
    /**
     * @param string $code
     */
    public function __construct($code)
    {
        parent::__construct(sprintf('OneToMany "%s" does not exist.', $code));
    }
}
