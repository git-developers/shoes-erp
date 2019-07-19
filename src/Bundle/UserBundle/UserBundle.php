<?php

declare(strict_types=1);

namespace Bundle\UserBundle;

use Bundle\ResourceBundle\AbstractResourceBundle;
use Bundle\ResourceBundle\ResourceBundle;

final class UserBundle extends AbstractResourceBundle
{
    /**
     * {@inheritdoc}
     */
    public function getSupportedDrivers(): array
    {
        return [
            ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelNamespace(): string
    {
        return 'Component\User\Model';
    }

}
