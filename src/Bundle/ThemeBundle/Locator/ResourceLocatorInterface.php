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

namespace Bundle\ThemeBundle\Locator;

use Bundle\ThemeBundle\Model\ThemeInterface;

interface ResourceLocatorInterface
{
    /**
     * @param string $resourceName
     * @param ThemeInterface $theme
     *
     * @return string
     *
     * @throws ResourceNotFoundException
     */
    public function locateResource(string $resourceName, ThemeInterface $theme): string;
}
