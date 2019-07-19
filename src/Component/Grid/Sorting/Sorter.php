<?php

declare(strict_types=1);

namespace Component\Grid\Sorting;

use Component\Grid\Data\DataSourceInterface;
use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;

final class Sorter implements SorterInterface
{
    /**
     * {@inheritdoc}
     */
    public function sort(DataSourceInterface $dataSource, Grid $grid, Parameters $parameters): void
    {
        $expressionBuilder = $dataSource->getExpressionBuilder();

        $sorting = $parameters->get('sorting', $grid->getSorting());

        foreach ($sorting as $field => $order) {
            $gridField = $grid->getField($field);
            $property = $gridField->getSortable();

            if (null !== $property) {
                $expressionBuilder->addOrderBy($property, $order);
            }
        }
    }
}
