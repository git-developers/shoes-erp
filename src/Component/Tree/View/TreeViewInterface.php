<?php

declare(strict_types=1);

namespace Component\Tree\View;

use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;

interface TreeViewInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return Tree
     */
    public function getDefinition(): Tree;

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
