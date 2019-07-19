<?php

namespace Bundle\TreeBundle\Services\Tree\BuildInterface;


interface TreeInterface
{
    public function findAll($limit = null, $offset = null);
}
