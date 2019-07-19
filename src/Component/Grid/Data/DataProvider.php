<?php

declare(strict_types=1);

namespace Component\Grid\Data;

use Component\Grid\Definition\Grid;
use Component\Grid\Filtering\FiltersApplicatorInterface;
use Component\Grid\Parameters;
use Component\Grid\Sorting\SorterInterface;

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
    public function getData(Grid $grid, Parameters $parameters)
    {
        $dataSource = $this->dataSourceProvider->getDataSource($grid, $parameters);

        $this->filtersApplicator->apply($dataSource, $grid, $parameters);
        $this->sorter->sort($dataSource, $grid, $parameters);

        return $dataSource->getData($parameters);
    }
}
