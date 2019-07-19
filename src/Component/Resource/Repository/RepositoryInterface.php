<?php

declare(strict_types=1);

namespace Component\Resource\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Component\Resource\Model\ResourceInterface;

interface RepositoryInterface extends ObjectRepository
{
    const ORDER_ASCENDING = 'ASC';
    const ORDER_DESCENDING = 'DESC';

    /**
     * @param array $criteria
     * @param array $sorting
     *
     * @return iterable
     */
    public function createPaginator(array $criteria = [], array $sorting = []);

    /**
     * @param ResourceInterface $resource
     */
    public function add(ResourceInterface $resource);

    /**
     * @param ResourceInterface $resource
     */
    public function remove(ResourceInterface $resource);
}
