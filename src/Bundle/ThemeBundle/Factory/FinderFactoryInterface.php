<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Factory;

use Symfony\Component\Finder\Finder;

interface FinderFactoryInterface
{
    /**
     * @return Finder
     */
    public function create(): Finder;
}
