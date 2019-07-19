<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

use Component\Resource\Factory\FactoryInterface;
use Component\Resource\Model\ResourceInterface;

final class NewResourceFactory implements NewResourceFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(RequestConfiguration $requestConfiguration, FactoryInterface $factory): ResourceInterface
    {
        if (null === $method = $requestConfiguration->getFactoryMethod()) {
            return $factory->createNew();
        }

        $arguments = array_values($requestConfiguration->getFactoryArguments());

        return $factory->$method(...$arguments);
    }
}
