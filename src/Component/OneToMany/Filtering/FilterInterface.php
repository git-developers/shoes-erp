<?php

declare(strict_types=1);

namespace Component\OneToMany\Filtering;

use Component\OneToMany\Data\DataSourceInterface;

interface FilterInterface
{
    /**
     * @param DataSourceInterface $dataSource
     * @param string $name
     * @param mixed $data
     * @param array $options
     */
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void;
}
