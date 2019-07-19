<?php

declare(strict_types=1);

namespace Component\Tree\Provider;

use Component\Tree\Definition\ArrayToDefinitionConverterInterface;
use Component\Tree\Definition\Tree;
use Component\Tree\Exception\UndefinedTreeException;

final class ArrayTreeProvider implements TreeProviderInterface
{
    /**
     * @var Tree[]
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
    public function get(string $code): Tree
    {
        if (!array_key_exists($code, $this->grids)) {
            throw new UndefinedTreeException($code);
        }

        // Need to clone grid definition in case of displaying on one page two grids using the same grid definition
        return clone $this->grids[$code];
    }

    /**
     * @param array $gridConfiguration
     * @param array $parentTreeConfiguration
     *
     * @return array
     */
    private function extend(array $gridConfiguration, array $parentTreeConfiguration): array
    {
        unset($parentTreeConfiguration['sorting']); // Do not inherit sorting.

        $configuration = array_replace_recursive($parentTreeConfiguration, $gridConfiguration);

        unset($configuration['extends']);

        return $configuration;
    }
}
