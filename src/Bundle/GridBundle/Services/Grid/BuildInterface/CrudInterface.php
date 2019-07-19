<?php

namespace Bundle\GridBundle\Services\Grid\BuildInterface;


interface CrudInterface
{
    public function findAll($limit = null, $offset = null);
}
