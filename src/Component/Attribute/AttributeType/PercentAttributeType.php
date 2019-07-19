<?php

declare(strict_types=1);

namespace Component\Attribute\AttributeType;

use Component\Attribute\Model\AttributeValueInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final class PercentAttributeType implements AttributeTypeInterface
{
    public const TYPE = 'percent';

    /**
     * {@inheritdoc}
     */
    public function getStorageType(): string
    {
        return AttributeValueInterface::STORAGE_FLOAT;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return static::TYPE;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(
        AttributeValueInterface $attributeValue,
        ExecutionContextInterface $context,
        array $configuration
    ): void {
        if (!isset($configuration['required'])) {
            return;
        }

        $value = $attributeValue->getValue();

        foreach ($this->getValidationErrors($context, $value) as $error) {
            $context
                ->buildViolation($error->getMessage())
                ->atPath('value')
                ->addViolation()
            ;
        }
    }

    /**
     * @param ExecutionContextInterface $context
     * @param float|null $value
     *
     * @return ConstraintViolationListInterface
     */
    private function getValidationErrors(ExecutionContextInterface $context, ?float $value): ConstraintViolationListInterface
    {
        return $context->getValidator()->validate($value, [new NotBlank([])]);
    }
}
