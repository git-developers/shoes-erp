<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Filtering;

use Component\TreeOneToMany\Definition\Filter;
use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;

final class FiltersCriteriaResolver implements FiltersCriteriaResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function hasCriteria(TreeOneToMany $grid, Parameters $parameters): bool
    {
        return $parameters->has('criteria') || !empty($this->getFiltersDefaultCriteria($grid->getFilters()));
    }

    /**
     * {@inheritdoc}
     */
    public function getCriteria(TreeOneToMany $grid, Parameters $parameters): array
    {
        $defaultCriteria = array_map(function (Filter $filter) {
            return $filter->getCriteria();
        }, $this->getFiltersDefaultCriteria($grid->getFilters()));

        return $parameters->get('criteria', $defaultCriteria);
    }

    /**
     * @param Filter[] $filters
     *
     * @return Filter[]
     */
    private function getFiltersDefaultCriteria(array $filters): array
    {
        return array_filter($filters, function (Filter $filter) {
            return null !== $filter->getCriteria();
        });
    }
}
