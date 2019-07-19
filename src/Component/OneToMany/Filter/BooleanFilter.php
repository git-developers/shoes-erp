<?php

declare(strict_types=1);

namespace Component\OneToMany\Filter;

use Component\OneToMany\Data\DataSourceInterface;
use Component\OneToMany\Filtering\FilterInterface;

final class BooleanFilter implements FilterInterface
{
    public const TRUE = 'true';
    public const FALSE = 'false';

    /**
     * {@inheritdoc}
     */
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    {
        if (empty($data)) {
            return;
        }

        $field = $options['field'] ?? $name;

        $data = self::TRUE === $data;

        $dataSource->restrict($dataSource->getExpressionBuilder()->equals($field, $data));
    }
}
