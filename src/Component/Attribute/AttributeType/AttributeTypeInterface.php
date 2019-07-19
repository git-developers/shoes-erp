<?php

declare(strict_types=1);

namespace Component\Attribute\AttributeType;

use Component\Attribute\Model\AttributeValueInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

interface AttributeTypeInterface
{
    /**
     * @return string
     */
    public function getStorageType(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param AttributeValueInterface $attributeValue
     * @param ExecutionContextInterface $context
     * @param array $configuration
     */
    public function validate(
        AttributeValueInterface $attributeValue,
        ExecutionContextInterface $context,
        array $configuration
    ): void;
}
