<?php

declare(strict_types=1);

namespace Component\Order\View;

use Component\Order\Definition\Order;
use Component\Order\Parameters;

interface OrderViewInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return Order
     */
    public function getDefinition(): Order;

    /**
     * @return Parameters
     */
    public function getParameters(): Parameters;

    /**
     * @param string $fieldName
     *
     * @return string|null
     */
    public function getSortingOrder(string $fieldName): ?string;

    /**
     * @param string $fieldName
     *
     * @return bool
     */
    public function isSortedBy(string $fieldName): bool;
}
