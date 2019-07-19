<?php

declare(strict_types=1);

namespace Component\Grid\View;

use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;

interface GridViewInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return Grid
     */
    public function getDefinition(): Grid;

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
