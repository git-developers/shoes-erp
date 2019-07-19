<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\OneToMany\View;

use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;
use Component\OneToMany\View\OneToManyView;
use Component\Resource\Metadata\MetadataInterface;

class ResourceOneToManyView extends OneToManyView
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
     * @param OneToMany $gridDefinition
     * @param Parameters $parameters
     * @param MetadataInterface $resourceMetadata
     * @param RequestConfiguration $requestConfiguration
     */
    public function __construct(
        $data,
        OneToMany $gridDefinition,
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
