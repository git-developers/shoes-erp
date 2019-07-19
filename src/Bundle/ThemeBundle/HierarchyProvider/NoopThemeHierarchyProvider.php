<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bundle\ThemeBundle\HierarchyProvider;

use Bundle\ThemeBundle\Model\ThemeInterface;

final class NoopThemeHierarchyProvider implements ThemeHierarchyProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getThemeHierarchy(ThemeInterface $theme): array
    {
        return [$theme];
    }
}
