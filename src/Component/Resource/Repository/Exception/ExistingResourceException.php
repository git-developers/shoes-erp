<?php

declare(strict_types=1);

namespace Component\Resource\Repository\Exception;

class ExistingResourceException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Given resource already exists in the repository.');
    }
}
