<?php

declare(strict_types=1);

namespace Component\Google\View;

use Component\Google\Definition\Google;
use Component\Google\Parameters;

interface GoogleViewInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return Google
     */
    public function getDefinition(): Google;

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
