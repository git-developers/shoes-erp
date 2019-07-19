<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Loader;

use Bundle\ThemeBundle\Model\ThemeInterface;

final class CircularDependencyChecker implements CircularDependencyCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function check(ThemeInterface $theme, array $previousThemes = []): void
    {
        if (0 === count($theme->getParents())) {
            return;
        }

        $previousThemes = array_merge($previousThemes, [$theme]);
        foreach ($theme->getParents() as $parent) {
            if (in_array($parent, $previousThemes, true)) {
                throw new CircularDependencyFoundException(array_merge($previousThemes, [$parent]));
            }

            $this->check($parent, $previousThemes);
        }
    }
}
