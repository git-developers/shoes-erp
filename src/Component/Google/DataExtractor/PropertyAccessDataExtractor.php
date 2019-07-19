<?php

declare(strict_types=1);

namespace Component\Google\DataExtractor;

use Component\Google\Definition\Field;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

final class PropertyAccessDataExtractor implements DataExtractorInterface
{
    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * @param PropertyAccessorInterface $propertyAccessor
     */
    public function __construct(PropertyAccessorInterface $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * {@inheritdoc}
     */
    public function get(Field $field, $data)
    {
        return $this->propertyAccessor->getValue($data, $field->getPath());
    }
}
