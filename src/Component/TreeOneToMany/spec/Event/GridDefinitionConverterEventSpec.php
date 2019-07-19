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

namespace spec\Component\TreeOneToMany\Event;

use PhpSpec\ObjectBehavior;
use Component\TreeOneToMany\Definition\TreeOneToMany;

final class TreeOneToManyDefinitionConverterEventSpec extends ObjectBehavior
{
    function let(TreeOneToMany $grid): void
    {
        $this->beConstructedWith($grid);
    }

    function it_has_a_grid(TreeOneToMany $grid): void
    {
        $this->getTreeOneToMany()->shouldReturn($grid);
    }
}
