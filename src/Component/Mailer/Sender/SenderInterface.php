<?php

declare(strict_types=1);

namespace Component\Mailer\Sender;

interface SenderInterface
{
    /**
     * @param string $code
     * @param array $recipients
     * @param array $data
     * @param array $attachments
     * @param array $replyTo
     */
    public function send(string $code, array $recipients, array $data = [], array $attachments = [], array $replyTo = []): void;
}
