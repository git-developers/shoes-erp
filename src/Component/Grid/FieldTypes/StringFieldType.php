<?php

declare(strict_types=1);

namespace Component\Grid\FieldTypes;

use Component\Grid\DataExtractor\DataExtractorInterface;
use Component\Grid\Definition\Field;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class StringFieldType implements FieldTypeInterface
{
    /**
     * @var DataExtractorInterface
     */
    private $dataExtractor;

    /**
     * @param DataExtractorInterface $dataExtractor
     */
    public function __construct(DataExtractorInterface $dataExtractor)
    {
        $this->dataExtractor = $dataExtractor;
    }

    /**
     * {@inheritdoc}
     */
    public function render(Field $field, $data, array $options)
    {
        $value = $this->dataExtractor->get($field, $data);

        return is_string($value) ? htmlspecialchars($value) : $value;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
    }
}
