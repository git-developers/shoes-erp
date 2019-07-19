<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Sorting;

use Component\TreeOneToMany\Data\DataSourceInterface;
use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;

final class Sorter implements SorterInterface
{
    /**
     * {@inheritdoc}
     */
    public function sort(DataSourceInterface $dataSource, TreeOneToMany $grid, Parameters $parameters): void
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
