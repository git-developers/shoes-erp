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

namespace spec\Component\Tree\View;

use PhpSpec\ObjectBehavior;
use Component\Tree\Data\DataProviderInterface;
use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;
use Component\Tree\View\TreeView;
use Component\Tree\View\TreeViewFactoryInterface;

final class TreeViewFactorySpec extends ObjectBehavior
{
    function let(DataProviderInterface $dataProvider): void
    {
        $this->beConstructedWith($dataProvider);
    }

    function it_implements_grid_view_factory_interface(): void
    {
        $this->shouldImplement(TreeViewFactoryInterface::class);
    }

    function it_uses_data_provider_to_create_a_view_with_data_and_definition(
        DataProviderInterface $dataProvider,
        Tree $grid
    ): void {
        $parameters = new Parameters();

        $expectedTreeView = new TreeView(['foo', 'bar'], $grid->getWrappedObject(), $parameters);

        $dataProvider->getData($grid, $parameters)->willReturn(['foo', 'bar']);

        $this->create($grid, $parameters)->shouldBeLike($expectedTreeView);
    }
}
