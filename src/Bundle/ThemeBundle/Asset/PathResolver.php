<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Asset;

use Bundle\ThemeBundle\Model\ThemeInterface;

final class PathResolver implements PathResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolve(string $path, ThemeInterface $theme): string
    {
        return str_replace('bundles/', 'bundles/_themes/' . $theme->getName() . '/', $path);
    }
}
