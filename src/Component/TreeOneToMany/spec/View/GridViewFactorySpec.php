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

namespace spec\Component\TreeOneToMany\View;

use PhpSpec\ObjectBehavior;
use Component\TreeOneToMany\Data\DataProviderInterface;
use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;
use Component\TreeOneToMany\View\TreeOneToManyView;
use Component\TreeOneToMany\View\TreeOneToManyViewFactoryInterface;

final class TreeOneToManyViewFactorySpec extends ObjectBehavior
{
    function let(DataProviderInterface $dataProvider): void
    {
        $this->beConstructedWith($dataProvider);
    }

    function it_implements_grid_view_factory_interface(): void
    {
        $this->shouldImplement(TreeOneToManyViewFactoryInterface::class);
    }

    function it_uses_data_provider_to_create_a_view_with_data_and_definition(
        DataProviderInterface $dataProvider,
        TreeOneToMany $grid
    ): void {
        $parameters = new Parameters();

        $expectedTreeOneToManyView = new TreeOneToManyView(['foo', 'bar'], $grid->getWrappedObject(), $parameters);

        $dataProvider->getData($grid, $parameters)->willReturn(['foo', 'bar']);

        $this->create($grid, $parameters)->shouldBeLike($expectedTreeOneToManyView);
    }
}
