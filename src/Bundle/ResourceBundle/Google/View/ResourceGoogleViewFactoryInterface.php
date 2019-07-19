<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Google\View;

use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Component\Google\Definition\Google;
use Component\Google\Parameters;
use Component\Resource\Metadata\MetadataInterface;

interface ResourceGoogleViewFactoryInterface
{
    /**
     * @param Google $grid
     * @param Parameters $parameters
     * @param MetadataInterface $metadata
     * @param RequestConfiguration $requestConfiguration
     *
     * @return ResourceTreeGoogleView
     */
    public function create(
        Google $grid,
        Parameters $parameters,
        MetadataInterface $metadata,
        RequestConfiguration $requestConfiguration
    ): ResourceTreeGoogleView;
}
