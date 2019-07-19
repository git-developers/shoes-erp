<?php

declare(strict_types=1);

namespace Component\OneToMany\Filter;

use Component\OneToMany\Data\DataSourceInterface;
use Component\OneToMany\Filtering\FilterInterface;

final class ExistsFilter implements FilterInterface
{
    public const TRUE = true;
    public const FALSE = false;

    /**
     * {@inheritdoc}
     */
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    {
        if (null === $data) {
            return;
        }

        $field = $options['field'] ?? $name;

        if (self::TRUE === (bool) $data) {
            $dataSource->restrict($dataSource->getExpressionBuilder()->isNotNull($field));

            return;
        }

        $dataSource->restrict($dataSource->getExpressionBuilder()->isNull($field));
    }
}
