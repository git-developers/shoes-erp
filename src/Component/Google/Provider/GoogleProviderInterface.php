<?php

declare(strict_types=1);

namespace Component\Google\Provider;

use Component\Google\Definition\Google;
use Component\Google\Exception\UndefinedGoogleException;

interface GoogleProviderInterface
{
    /**
     * @param string $code
     *
     * @return Google
     *
     * @throws UndefinedGoogleException
     */
    public function get(string $code): Google;
}
