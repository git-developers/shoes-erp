<?php

declare(strict_types=1);

namespace Component\Google\FieldTypes;

use Component\Google\Definition\Field;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface FieldTypeInterface
{
    /**
     * Return a HTML representation of the $field using the given $data and
     * $options.
     *
     * @param Field $field
     * @param mixed $data
     * @param array $options
     *
     * @return mixed
     */
    public function render(Field $field, $data, array $options);

    /**
     * Configure options for this field type.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void;
}
