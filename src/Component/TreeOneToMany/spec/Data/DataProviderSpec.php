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

namespace spec\Component\TreeOneToMany\Data;

use PhpSpec\ObjectBehavior;
use Component\TreeOneToMany\Data\DataProviderInterface;
use Component\TreeOneToMany\Data\DataSourceInterface;
use Component\TreeOneToMany\Data\DataSourceProviderInterface;
use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Filtering\FiltersApplicatorInterface;
use Component\TreeOneToMany\Parameters;
use Component\TreeOneToMany\Sorting\SorterInterface;

final class DataProviderSpec extends ObjectBehavior
{
    function let(
        DataSourceProviderInterface $dataSourceProvider,
        FiltersApplicatorInterface $filtersApplicator,
        SorterInterface $sorter
    ): void {
        $this->beConstructedWith($dataSourceProvider, $filtersApplicator, $sorter);
    }

    function it_implements_grid_data_provider_interface(): void
    {
        $this->shouldImplement(DataProviderInterface::class);
    }

    function it_gets_data_from_the_data_source(
        DataSourceProviderInterface $dataSourceProvider,
        DataSourceInterface $dataSource,
        FiltersApplicatorInterface $filtersApplicator,
        SorterInterface $sorter,
        TreeOneToMany $grid
    ): void {
        $parameters = new Parameters();

        $dataSourceProvider->getDataSource($grid, $parameters)->willReturn($dataSource);

        $filtersApplicator->apply($dataSource, $grid, $parameters)->shouldBeCalled();
        $sorter->sort($dataSource, $grid, $parameters)->shouldBeCalled();

        $dataSource->getData($parameters)->willReturn(['foo', 'bar']);

        $this->getData($grid, $parameters)->shouldReturn(['foo', 'bar']);
    }
}
