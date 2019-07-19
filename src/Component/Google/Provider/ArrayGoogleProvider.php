<?php

declare(strict_types=1);

namespace Component\Google\Provider;

use Component\Google\Definition\ArrayToDefinitionConverterInterface;
use Component\Google\Definition\Google;
use Component\Google\Exception\UndefinedGoogleException;

final class ArrayGoogleProvider implements GoogleProviderInterface
{
    /**
     * @var Google[]
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
    public function get(string $code): Google
    {
        if (!array_key_exists($code, $this->grids)) {
            throw new UndefinedGoogleException($code);
        }

        // Need to clone grid definition in case of displaying on one page two grids using the same grid definition
        return clone $this->grids[$code];
    }

    /**
     * @param array $gridConfiguration
     * @param array $parentGoogleConfiguration
     *
     * @return array
     */
    private function extend(array $gridConfiguration, array $parentGoogleConfiguration): array
    {
        unset($parentGoogleConfiguration['sorting']); // Do not inherit sorting.

        $configuration = array_replace_recursive($parentGoogleConfiguration, $gridConfiguration);

        unset($configuration['extends']);

        return $configuration;
    }
}
