<?php

declare(strict_types=1);

namespace Component\Grid\Provider;

use Component\Grid\Definition\ArrayToDefinitionConverterInterface;
use Component\Grid\Definition\Grid;
use Component\Grid\Exception\UndefinedGridException;

final class ArrayGridProvider implements GridProviderInterface
{
    /**
     * @var Grid[]
     */
    private $grids = [];

    /**
     * @param ArrayToDefinitionConverterInterface $converter
     * @param array $gridConfigurations
     */
    public function __construct(ArrayToDefinitionConverterInterface $converter, array $gridConfigurations)
    {
        foreach ($gridConfigurations as $code => $gridConfiguration) {
            if (isset($gridConfiguration['extends'], $gridConfigurations[$gridConfiguration['extends']])) {
                $gridConfiguration = $this->extend($gridConfiguration, $gridConfigurations[$gridConfiguration['extends']]);
            }

            $this->grids[$code] = $converter->convert($code, $gridConfiguration);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $code): Grid
    {
        if (!array_key_exists($code, $this->grids)) {
            throw new UndefinedGridException($code);
        }

        // Need to clone grid definition in case of displaying on one page two grids using the same grid definition
        return clone $this->grids[$code];
    }

    /**
     * @param array $gridConfiguration
     * @param array $parentGridConfiguration
     *
     * @return array
     */
    private function extend(array $gridConfiguration, array $parentGridConfiguration): array
    {
        unset($parentGridConfiguration['sorting']); // Do not inherit sorting.

        $configuration = array_replace_recursive($parentGridConfiguration, $gridConfiguration);

        unset($configuration['extends']);

        return $configuration;
    }
}
