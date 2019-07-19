<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Asset;

use Bundle\ThemeBundle\Model\ThemeInterface;

interface PathResolverInterface
{
    /**
     * Applies theme hashcode to given asset file in order to distinguish it from
     * another same named assets files with another theme or without it.
     *
     * @param string $path
     * @param ThemeInterface $theme
     *
     * @return string
     */
    public function resolve(string $path, ThemeInterface $theme): string;
}
