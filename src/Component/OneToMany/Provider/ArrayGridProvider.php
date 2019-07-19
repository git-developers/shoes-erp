<?php

declare(strict_types=1);

namespace Component\OneToMany\Provider;

use Component\OneToMany\Definition\ArrayToDefinitionConverterInterface;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Exception\UndefinedOneToManyException;

final class ArrayOneToManyProvider implements OneToManyProviderInterface
{
    /**
     * @var OneToMany[]
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
    public function get(string $code): OneToMany
    {
        if (!array_key_exists($code, $this->grids)) {
            throw new UndefinedOneToManyException($code);
        }

        // Need to clone grid definition in case of displaying on one page two grids using the same grid definition
        return clone $this->grids[$code];
    }

    /**
     * @param array $gridConfiguration
     * @param array $parentOneToManyConfiguration
     *
     * @return array
     */
    private function extend(array $gridConfiguration, array $parentOneToManyConfiguration): array
    {
        unset($parentOneToManyConfiguration['sorting']); // Do not inherit sorting.

        $configuration = array_replace_recursive($parentOneToManyConfiguration, $gridConfiguration);

        unset($configuration['extends']);

        return $configuration;
    }
}
