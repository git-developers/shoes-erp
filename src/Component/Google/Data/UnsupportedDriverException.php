<?php

declare(strict_types=1);

namespace Component\Google\Data;

class UnsupportedDriverException extends \InvalidArgumentException
{
    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct(sprintf('Google data driver "%s" is not supported.', $name));
    }
}
