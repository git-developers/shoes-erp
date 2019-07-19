<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

use Component\Resource\Metadata\MetadataInterface;
use Symfony\Component\HttpFoundation\Request;

interface RequestConfigurationFactoryInterface
{
    /**
     * @param MetadataInterface $metadata
     * @param Request $request
     *
     * @return RequestConfiguration
     *
     * @throws \InvalidArgumentException
     */
//    public function create(Request $request): RequestConfiguration;
    public function create(MetadataInterface $metadata, Request $request);
}
