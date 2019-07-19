<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\View;

use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;

interface TreeOneToManyViewInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return TreeOneToMany
     */
    public function getDefinition(): TreeOneToMany;

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
