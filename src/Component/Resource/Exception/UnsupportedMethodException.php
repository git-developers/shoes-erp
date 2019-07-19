<?php

declare(strict_types=1);

namespace Component\Resource\Exception;

class UnsupportedMethodException extends \Exception
{
    /**
     * @param string $methodName
     */
    public function __construct(string $methodName)
    {
        parent::__construct(sprintf(
            'The method "%s" is not supported.',
            $methodName
        ));
    }
}
