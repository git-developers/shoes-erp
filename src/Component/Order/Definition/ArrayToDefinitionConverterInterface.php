<?php

declare(strict_types=1);

namespace Component\Order\Definition;

interface ArrayToDefinitionConverterInterface
{
    /**
     * @param string $code
     * @param array $configuration
     *
     * @return Order
     */
    public function convert(string $code, array $configuration): Order;
}
