<?php

declare(strict_types=1);

namespace Component\Mailer\Provider;

interface DefaultSettingsProviderInterface
{
    /**
     * @return string
     */
    public function getSenderName(): string;

    /**
     * @return string
     */
    public function getSenderAddress(): string;
}
