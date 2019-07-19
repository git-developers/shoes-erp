<?php

declare(strict_types=1);

namespace Component\OneToMany\Data;

use Component\OneToMany\Parameters;

interface DriverInterface
{
    /**
     * @param array $configuration
     * @param Parameters $parameters
     *
     * @return DataSourceInterface
     */
    public function getDataSource(array $configuration, Parameters $parameters): DataSourceInterface;
}
