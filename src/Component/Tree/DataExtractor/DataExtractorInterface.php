<?php

declare(strict_types=1);

namespace Component\Tree\DataExtractor;

use Component\Tree\Definition\Field;

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
