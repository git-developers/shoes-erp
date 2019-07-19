<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

use Component\Resource\Repository\RepositoryInterface;

interface ResourcesResolverInterface
{
    /**
     * @param RequestConfiguration $requestConfiguration
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function getResources(RequestConfiguration $requestConfiguration, RepositoryInterface $repository);
}
