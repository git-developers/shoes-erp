<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

interface AuthorizationCheckerInterface
{
    /**
     * Checks if user is authorized based on the current request configuration and specific permission.
     *
     * Sample permissions:
     *
     * - create
     * - show
     * - delete
     * - custom_action
     *
     * @param RequestConfiguration $configuration
     * @param string $permission
     *
     * @return bool
     */
    public function isGranted(RequestConfiguration $configuration, string $permission): bool;
}
