<?php

declare(strict_types=1);

namespace Component\OneToMany\Sorting;

use Component\OneToMany\Data\DataSourceInterface;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

final class Sorter implements SorterInterface
{
    /**
     * {@inheritdoc}
     */
    public function sort(DataSourceInterface $dataSource, OneToMany $grid, Parameters $parameters): void
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
