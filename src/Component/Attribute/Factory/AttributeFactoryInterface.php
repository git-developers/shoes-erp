<?php

declare(strict_types=1);

namespace Component\Attribute\Factory;

use Component\Attribute\Model\AttributeInterface;
use Component\Resource\Factory\FactoryInterface;

interface AttributeFactoryInterface extends FactoryInterface
{
    /**
     * @param string $type
     *
     * @return AttributeInterface
     */
    public function createTyped(string $type): AttributeInterface;
}
