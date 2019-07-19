<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

use Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Component\Resource\Model\ResourceInterface;

interface EventDispatcherInterface
{
    /**
     * @param string $eventName
     * @param RequestConfiguration $requestConfiguration
     * @param ResourceInterface $resource
     *
     * @return ResourceControllerEvent
     */
    public function dispatch(
        string $eventName,
        RequestConfiguration $requestConfiguration,
        ResourceInterface $resource
    ): ResourceControllerEvent;

    /**
     * @param string $eventName
     * @param RequestConfiguration $requestConfiguration
     * @param mixed $resources
     *
     * @return ResourceControllerEvent
     */
    public function dispatchMultiple(
        string $eventName,
        RequestConfiguration $requestConfiguration,
        $resources
    ): ResourceControllerEvent;

    /**
     * @param string $eventName
     * @param RequestConfiguration $requestConfiguration
     * @param ResourceInterface $resource
     *
     * @return ResourceControllerEvent
     */
    public function dispatchPreEvent(
        string $eventName,
        RequestConfiguration $requestConfiguration,
        ResourceInterface $resource
    ): ResourceControllerEvent;

    /**
     * @param string $eventName
     * @param RequestConfiguration $requestConfiguration
     * @param ResourceInterface $resource
     *
     * @return ResourceControllerEvent
     */
    public function dispatchPostEvent(
        string $eventName,
        RequestConfiguration $requestConfiguration,
        ResourceInterface $resource
    ): ResourceControllerEvent;

    /**
     * @param string $eventName
     * @param RequestConfiguration $requestConfiguration
     * @param ResourceInterface $resource
     *
     * @return ResourceControllerEvent
     */
    public function dispatchInitializeEvent(
        string $eventName,
        RequestConfiguration $requestConfiguration,
        ResourceInterface $resource
    ): ResourceControllerEvent;
}
