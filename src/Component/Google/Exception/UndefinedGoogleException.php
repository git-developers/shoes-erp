<?php

declare(strict_types=1);

namespace Component\Google\Exception;

class UndefinedGoogleException extends \InvalidArgumentException
{
    /**
     * @param string $code
     */
    public function __construct($code)
    {
        parent::__construct(sprintf('Google "%s" does not exist.', $code));
    }
}
