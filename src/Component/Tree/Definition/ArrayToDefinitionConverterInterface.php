<?php

declare(strict_types=1);

namespace Component\Tree\Definition;

interface ArrayToDefinitionConverterInterface
{
    /**
     * @param string $code
     * @param array $configuration
     *
     * @return Tree
     */
    public function convert(string $code, array $configuration): Tree;
}
