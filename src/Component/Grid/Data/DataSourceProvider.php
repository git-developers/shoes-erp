<?php

declare(strict_types=1);

namespace Component\Grid\Data;

use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;
use Component\Registry\ServiceRegistryInterface;

final class DataSourceProvider implements DataSourceProviderInterface
{
    /**
     * @var ServiceRegistryInterface
     */
    private $driversRegistry;

    /**
     * @param ServiceRegistryInterface $driversRegistry
     */
    public function __construct(ServiceRegistryInterface $driversRegistry)
    {
        $this->driversRegistry = $driversRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSource(Grid $grid, Parameters $parameters): DataSourceInterface
    {
        $driverName = $grid->getDriver();

        if (!$this->driversRegistry->has($driverName)) {
            throw new UnsupportedDriverException($driverName);
        }

        /** @var DriverInterface $driver */
        $driver = $this->driversRegistry->get($driverName);

        return $driver->getDataSource($grid->getDriverConfiguration(), $parameters);
    }
}
