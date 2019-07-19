<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

final class RecursiveTransformer implements DataTransformerInterface
{
    /**
     * @var DataTransformerInterface
     */
    private $decoratedTransformer;

    /**
     * @param DataTransformerInterface $decoratedTransformer
     */
    public function __construct(DataTransformerInterface $decoratedTransformer)
    {
        $this->decoratedTransformer = $decoratedTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($values): Collection
    {
        if (null === $values) {
            return new ArrayCollection();
        }

        $this->assertTransformationValueType($values, Collection::class);

        return $values->map(function ($value) {
            return $this->decoratedTransformer->transform($value);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($values): Collection
    {
        if (null === $values) {
            return new ArrayCollection();
        }

        $this->assertTransformationValueType($values, Collection::class);

        return $values->map(function ($value) {
            return $this->decoratedTransformer->reverseTransform($value);
        });
    }

    /**
     * @param mixed $value
     * @param string $expectedType
     *
     * @throws TransformationFailedException
     */
    private function assertTransformationValueType($value, string $expectedType): void
    {
        if (!($value instanceof $expectedType)) {
            throw new TransformationFailedException(
                sprintf(
                    'Expected "%s", but got "%s"',
                    $expectedType,
                    is_object($value) ? get_class($value) : gettype($value)
                )
            );
        }
    }
}
