<?php

declare(strict_types=1);

namespace Component\Order\DataExtractor;

use Component\Order\Definition\Field;

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
