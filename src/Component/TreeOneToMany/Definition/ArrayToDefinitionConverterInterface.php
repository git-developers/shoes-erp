<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Definition;

interface ArrayToDefinitionConverterInterface
{
    /**
     * @param string $code
     * @param array $configuration
     *
     * @return TreeOneToMany
     */
    public function convert(string $code, array $configuration): TreeOneToMany;
}
