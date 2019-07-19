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

namespace spec\Component\Tree\Event;

use PhpSpec\ObjectBehavior;
use Component\Tree\Definition\Tree;

final class TreeDefinitionConverterEventSpec extends ObjectBehavior
{
    function let(Tree $grid): void
    {
        $this->beConstructedWith($grid);
    }

    function it_has_a_grid(Tree $grid): void
    {
        $this->getTree()->shouldReturn($grid);
    }
}
