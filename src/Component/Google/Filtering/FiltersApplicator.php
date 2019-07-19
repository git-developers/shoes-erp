<?php

declare(strict_types=1);

namespace Component\Google\Filtering;

use Component\Google\Data\DataSourceInterface;
use Component\Google\Definition\Google;
use Component\Google\Parameters;
use Component\Registry\ServiceRegistryInterface;

final class FiltersApplicator implements FiltersApplicatorInterface
{
    /**
     * @var ServiceRegistryInterface
     */
    private $filtersRegistry;

    /**
     * @var FiltersCriteriaResolverInterface
     */
    private $criteriaResolver;

    /**
     * @param ServiceRegistryInterface $filtersRegistry
     * @param FiltersCriteriaResolverInterface $criteriaResolver
     */
    public function __construct(
        ServiceRegistryInterface $filtersRegistry,
        FiltersCriteriaResolverInterface $criteriaResolver
    ) {
        $this->filtersRegistry = $filtersRegistry;
        $this->criteriaResolver = $criteriaResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(DataSourceInterface $dataSource, Google $grid, Parameters $parameters): void
    {
        if (!$this->criteriaResolver->hasCriteria($grid, $parameters)) {
            return;
        }

        $criteria = $this->criteriaResolver->getCriteria($grid, $parameters);
        foreach ($criteria as $name => $data) {
            if (!$grid->hasFilter($name)) {
                continue;
            }

            $gridFilter = $grid->getFilter($name);

            /** @var FilterInterface $filter */
            $filter = $this->filtersRegistry->get($gridFilter->getType());
            $filter->apply($dataSource, $name, $data, $gridFilter->getOptions());
        }
    }
}
