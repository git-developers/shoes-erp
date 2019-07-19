<?php

declare(strict_types=1);

namespace Component\OneToMany\Filtering;

use Component\OneToMany\Data\DataSourceInterface;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;
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
    public function apply(DataSourceInterface $dataSource, OneToMany $grid, Parameters $parameters): void
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
