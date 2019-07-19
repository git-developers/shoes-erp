<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Loader;

use Bundle\ThemeBundle\Model\ThemeInterface;

interface ThemeLoaderInterface
{
    /**
     * @return array|ThemeInterface[]
     *
     * @throws ThemeLoadingFailedException
     */
    public function load(): array;
}
