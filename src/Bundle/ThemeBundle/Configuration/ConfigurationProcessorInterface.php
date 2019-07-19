<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Configuration;

interface ConfigurationProcessorInterface
{
    /**
     * @param array $configs An array of configuration arrays
     *
     * @return array The processed configuration array
     */
    public function process(array $configs): array;
}
