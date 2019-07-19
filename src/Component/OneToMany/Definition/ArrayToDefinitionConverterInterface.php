<?php

declare(strict_types=1);

namespace Component\OneToMany\Definition;

interface ArrayToDefinitionConverterInterface
{
    /**
     * @param string $code
     * @param array $configuration
     *
     * @return OneToMany
     */
    public function convert(string $code, array $configuration): OneToMany;
}
