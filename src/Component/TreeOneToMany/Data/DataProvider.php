<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Data;

use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Filtering\FiltersApplicatorInterface;
use Component\TreeOneToMany\Parameters;
use Component\TreeOneToMany\Sorting\SorterInterface;

final class DataProvider implements DataProviderInterface
{
    /**
     * @var DataSourceProviderInterface
     */
    private $dataSourceProvider;

    /**
     * @var FiltersApplicatorInterface
     */
    private $filtersApplicator;

    /**
     * @var SorterInterface
     */
    private $sorter;

    /**
     * @param DataSourceProviderInterface $dataSourceProvider
     * @param FiltersApplicatorInterface $filtersApplicator
     * @param SorterInterface $sorter
     */
    public function __construct(
        DataSourceProviderInterface $dataSourceProvider,
        FiltersApplicatorInterface $filtersApplicator,
        SorterInterface $sorter
    ) {
        $this->dataSourceProvider = $dataSourceProvider;
        $this->filtersApplicator = $filtersApplicator;
        $this->sorter = $sorter;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(TreeOneToMany $grid, Parameters $parameters)
    {
        $dataSource = $this->dataSourceProvider->getDataSource($grid, $parameters);

        $this->filtersApplicator->apply($dataSource, $grid, $parameters);
        $this->sorter->sort($dataSource, $grid, $parameters);

        return $dataSource->getData($parameters);
    }
}
