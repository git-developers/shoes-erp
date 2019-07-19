<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Data;

use Component\TreeOneToMany\Parameters;

interface DataSourceInterface
{
    public const CONDITION_AND = 'and';
    public const CONDITION_OR = 'or';

    /**
     * @param mixed $expression
     * @param string $condition
     */
    public function restrict($expression, string $condition = self::CONDITION_AND): void;

    /**
     * @return ExpressionBuilderInterface
     */
    public function getExpressionBuilder(): ExpressionBuilderInterface;

    /**
     * @param Parameters $parameters
     *
     * @return mixed
     */
    public function getData(Parameters $parameters);
}
