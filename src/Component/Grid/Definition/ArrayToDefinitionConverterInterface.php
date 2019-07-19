<?php

declare(strict_types=1);

namespace Component\Grid\Definition;

interface ArrayToDefinitionConverterInterface
{
    /**
     * @param string $code
     * @param array $configuration
     *
     * @return Grid
     */
    public function convert(string $code, array $configuration): Grid;
}
