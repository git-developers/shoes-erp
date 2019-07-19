<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Provider;

use Component\TreeOneToMany\Definition\ArrayToDefinitionConverterInterface;
use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Exception\UndefinedTreeOneToManyException;

final class ArrayTreeOneToManyProvider implements TreeOneToManyProviderInterface
{
    /**
     * @var TreeOneToMany[]
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
    public function get(string $code): TreeOneToMany
    {
        if (!array_key_exists($code, $this->grids)) {
            throw new UndefinedTreeOneToManyException($code);
        }

        // Need to clone grid definition in case of displaying on one page two grids using the same grid definition
        return clone $this->grids[$code];
    }

    /**
     * @param array $gridConfiguration
     * @param array $parentTreeOneToManyConfiguration
     *
     * @return array
     */
    private function extend(array $gridConfiguration, array $parentTreeOneToManyConfiguration): array
    {
        unset($parentTreeOneToManyConfiguration['sorting']); // Do not inherit sorting.

        $configuration = array_replace_recursive($parentTreeOneToManyConfiguration, $gridConfiguration);

        unset($configuration['extends']);

        return $configuration;
    }
}
