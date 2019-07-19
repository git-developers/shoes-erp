<?php

declare(strict_types=1);

namespace Component\OneToMany\View;

use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

interface OneToManyViewInterface
{
    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return OneToMany
     */
    public function getDefinition(): OneToMany;

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
