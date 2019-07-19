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

namespace spec\Component\Grid\Filter;

use PhpSpec\ObjectBehavior;
use Component\Grid\Data\DataSourceInterface;
use Component\Grid\Data\ExpressionBuilderInterface;
use Component\Grid\Filter\BooleanFilter;
use Component\Grid\Filtering\FilterInterface;

final class BooleanFilterSpec extends ObjectBehavior
{
    function it_implements_filter_interface(): void
    {
        $this->shouldImplement(FilterInterface::class);
    }

    function it_filters_true_boolean_values(
        DataSourceInterface $dataSource,
        ExpressionBuilderInterface $expressionBuilder
    ): void {
        $dataSource->getExpressionBuilder()->willReturn($expressionBuilder);

        $expressionBuilder->equals('enabled', true)->willReturn('EXPR');
        $dataSource->restrict('EXPR')->shouldBeCalled();

        $this->apply($dataSource, 'enabled', BooleanFilter::TRUE, []);
    }

    function it_filters_false_boolean_values(
        DataSourceInterface $dataSource,
        ExpressionBuilderInterface $expressionBuilder
    ): void {
        $dataSource->getExpressionBuilder()->willReturn($expressionBuilder);

        $expressionBuilder->equals('enabled', false)->willReturn('EXPR');
        $dataSource->restrict('EXPR')->shouldBeCalled();

        $this->apply($dataSource, 'enabled', BooleanFilter::FALSE, []);
    }
}
