<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

use SM\Factory\FactoryInterface;
use Component\Resource\Model\ResourceInterface;

final class StateMachine implements StateMachineInterface
{
    /**
     * @var FactoryInterface
     */
    private $stateMachineFactory;

    /**
     * @param FactoryInterface $stateMachineFactory
     */
    public function __construct(FactoryInterface $stateMachineFactory)
    {
        $this->stateMachineFactory = $stateMachineFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function can(RequestConfiguration $configuration, ResourceInterface $resource): bool
    {
        if (!$configuration->hasStateMachine()) {
            throw new \InvalidArgumentException('State machine must be configured to apply transition, check your routing.');
        }

        return $this->stateMachineFactory->get($resource, $configuration->getStateMachineGraph())->can($configuration->getStateMachineTransition());
    }

    /**
     * {@inheritdoc}
     */
    public function apply(RequestConfiguration $configuration, ResourceInterface $resource): void
    {
        if (!$configuration->hasStateMachine()) {
            throw new \InvalidArgumentException('State machine must be configured to apply transition, check your routing.');
        }

        $this->stateMachineFactory->get($resource, $configuration->getStateMachineGraph())->apply($configuration->getStateMachineTransition());
    }
}
