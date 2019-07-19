<?php

declare(strict_types=1);

namespace Component\OneToMany\Provider;

use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Exception\UndefinedOneToManyException;

interface OneToManyProviderInterface
{
    /**
     * @param string $code
     *
     * @return OneToMany
     *
     * @throws UndefinedOneToManyException
     */
    public function get(string $code): OneToMany;
}
