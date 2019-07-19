<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

/**
 * This authorization checker always returns true. Useful if you don't want to have authorization checks at all.
 */
final class DisabledAuthorizationChecker implements AuthorizationCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function isGranted(RequestConfiguration $requestConfiguration, string $permission): bool
    {
        return true;
    }
}
