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

namespace spec\Component\OneToMany\View;

use PhpSpec\ObjectBehavior;
use Component\OneToMany\Data\DataProviderInterface;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;
use Component\OneToMany\View\OneToManyView;
use Component\OneToMany\View\OneToManyViewFactoryInterface;

final class OneToManyViewFactorySpec extends ObjectBehavior
{
    function let(DataProviderInterface $dataProvider): void
    {
        $this->beConstructedWith($dataProvider);
    }

    function it_implements_grid_view_factory_interface(): void
    {
        $this->shouldImplement(OneToManyViewFactoryInterface::class);
    }

    function it_uses_data_provider_to_create_a_view_with_data_and_definition(
        DataProviderInterface $dataProvider,
        OneToMany $grid
    ): void {
        $parameters = new Parameters();

        $expectedOneToManyView = new OneToManyView(['foo', 'bar'], $grid->getWrappedObject(), $parameters);

        $dataProvider->getData($grid, $parameters)->willReturn(['foo', 'bar']);

        $this->create($grid, $parameters)->shouldBeLike($expectedOneToManyView);
    }
}
