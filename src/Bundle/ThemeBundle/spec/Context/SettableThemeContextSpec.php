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

namespace spec\Bundle\ThemeBundle\Context;

use PhpSpec\ObjectBehavior;
use Bundle\ThemeBundle\Context\ThemeContextInterface;
use Bundle\ThemeBundle\Model\ThemeInterface;

final class SettableThemeContextSpec extends ObjectBehavior
{
    function it_implements_theme_context_interface(): void
    {
        $this->shouldImplement(ThemeContextInterface::class);
    }

    function it_has_theme(ThemeInterface $theme): void
    {
        $this->getTheme()->shouldReturn(null);

        $this->setTheme($theme);
        $this->getTheme()->shouldReturn($theme);
    }
}
