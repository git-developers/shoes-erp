<?php

declare(strict_types=1);

namespace Component\Google\Sorting;

use Component\Google\Data\DataSourceInterface;
use Component\Google\Definition\Google;
use Component\Google\Parameters;

final class Sorter implements SorterInterface
{
    /**
     * {@inheritdoc}
     */
    public function sort(DataSourceInterface $dataSource, Google $grid, Parameters $parameters): void
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
