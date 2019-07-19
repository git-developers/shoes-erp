<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

use Component\Resource\Repository\RepositoryInterface;

interface ResourcesCollectionProviderInterface
{
    /**
     * @param RequestConfiguration $requestConfiguration
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function get(RequestConfiguration $requestConfiguration, RepositoryInterface $repository);
}
