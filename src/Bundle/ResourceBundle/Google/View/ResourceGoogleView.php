<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Google\View;

use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Component\Google\Definition\Google;
use Component\Google\Parameters;
use Component\Google\View\GoogleView;
use Component\Resource\Metadata\MetadataInterface;

class ResourceGoogleView extends GoogleView
{
    /**
     * @var MetadataInterface
     */
    private $metadata;

    /**
     * @var RequestConfiguration
     */
    private $requestConfiguration;

    /**
     * @param mixed $data
     * @param Google $gridDefinition
     * @param Parameters $parameters
     * @param MetadataInterface $resourceMetadata
     * @param RequestConfiguration $requestConfiguration
     */
    public function __construct(
        $data,
        Google $gridDefinition,
        Parameters $parameters,
        MetadataInterface $resourceMetadata,
        RequestConfiguration $requestConfiguration
    ) {
        parent::__construct($data, $gridDefinition, $parameters);

        $this->metadata = $resourceMetadata;
        $this->requestConfiguration = $requestConfiguration;
    }

    /**
     * @return MetadataInterface
     */
    public function getMetadata(): MetadataInterface
    {
        return $this->metadata;
    }

    /**
     * @return RequestConfiguration
     */
    public function getRequestConfiguration(): RequestConfiguration
    {
        return $this->requestConfiguration;
    }
}
