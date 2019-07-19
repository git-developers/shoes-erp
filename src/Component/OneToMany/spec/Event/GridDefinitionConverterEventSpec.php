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

namespace spec\Component\OneToMany\Event;

use PhpSpec\ObjectBehavior;
use Component\OneToMany\Definition\OneToMany;

final class OneToManyDefinitionConverterEventSpec extends ObjectBehavior
{
    function let(OneToMany $grid): void
    {
        $this->beConstructedWith($grid);
    }

    function it_has_a_grid(OneToMany $grid): void
    {
        $this->getOneToMany()->shouldReturn($grid);
    }
}
