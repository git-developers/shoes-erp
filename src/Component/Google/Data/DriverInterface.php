<?php

declare(strict_types=1);

namespace Component\Google\Data;

use Component\Google\Parameters;

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
