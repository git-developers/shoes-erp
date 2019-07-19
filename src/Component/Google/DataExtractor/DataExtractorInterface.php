<?php

declare(strict_types=1);

namespace Component\Google\DataExtractor;

use Component\Google\Definition\Field;

interface DataExtractorInterface
{
    /**
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function get(Field $field, $data);
}
