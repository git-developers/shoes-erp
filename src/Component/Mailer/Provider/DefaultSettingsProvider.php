<?php

declare(strict_types=1);

namespace Component\Mailer\Provider;

final class DefaultSettingsProvider implements DefaultSettingsProviderInterface
{
    /**
     * @var string
     */
    private $senderName;

    /**
     * @var string
     */
    private $senderAddress;

    /**
     * @param string $senderName
     * @param string $senderAddress
     */
    public function __construct(string $senderName, string $senderAddress)
    {
        $this->senderName = $senderName;
        $this->senderAddress = $senderAddress;
    }

    /**
     * {@inheritdoc}
     */
    public function getSenderName(): string
    {
        return $this->senderName;
    }

    /**
     * {@inheritdoc}
     */
    public function getSenderAddress(): string
    {
        return $this->senderAddress;
    }
}
