<?php

declare(strict_types=1);

namespace Component\Tree\Sorting;

use Component\Tree\Data\DataSourceInterface;
use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;

final class Sorter implements SorterInterface
{
    /**
     * {@inheritdoc}
     */
    public function sort(DataSourceInterface $dataSource, Tree $grid, Parameters $parameters): void
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
