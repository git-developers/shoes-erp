<?php

declare(strict_types=1);

namespace Component\Google\Data;

use Component\Google\Definition\Google;
use Component\Google\Filtering\FiltersApplicatorInterface;
use Component\Google\Parameters;
use Component\Google\Sorting\SorterInterface;

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
    public function getData(Google $grid, Parameters $parameters)
    {
        $dataSource = $this->dataSourceProvider->getDataSource($grid, $parameters);

        $this->filtersApplicator->apply($dataSource, $grid, $parameters);
        $this->sorter->sort($dataSource, $grid, $parameters);

        return $dataSource->getData($parameters);
    }
}
