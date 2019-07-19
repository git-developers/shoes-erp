<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\HierarchyProvider;

use Bundle\ThemeBundle\Model\ThemeInterface;

interface ThemeHierarchyProviderInterface
{
    /**
     * @param ThemeInterface $theme
     *
     * @return array|ThemeInterface[]
     *
     * @throws \InvalidArgumentException If dependencies could not be resolved.
     */
    public function getThemeHierarchy(ThemeInterface $theme): array;
}
