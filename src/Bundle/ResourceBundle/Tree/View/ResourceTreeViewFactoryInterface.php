<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Tree\View;

use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;
use Component\Resource\Metadata\MetadataInterface;

interface ResourceTreeViewFactoryInterface
{
    /**
     * @param Tree $grid
     * @param Parameters $parameters
     * @param MetadataInterface $metadata
     * @param RequestConfiguration $requestConfiguration
     *
     * @return ResourceTreeView
     */
    public function create(
        Tree $grid,
        Parameters $parameters,
        MetadataInterface $metadata,
        RequestConfiguration $requestConfiguration
    ): ResourceTreeView;
}
