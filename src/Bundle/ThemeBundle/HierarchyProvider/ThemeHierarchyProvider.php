<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\HierarchyProvider;

use Bundle\ThemeBundle\Model\ThemeInterface;

final class ThemeHierarchyProvider implements ThemeHierarchyProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getThemeHierarchy(ThemeInterface $theme): array
    {
        $parents = [];
        foreach ($theme->getParents() as $parent) {
            $parents = array_merge(
                $parents,
                $this->getThemeHierarchy($parent)
            );
        }

        return array_merge([$theme], $parents);
    }
}
