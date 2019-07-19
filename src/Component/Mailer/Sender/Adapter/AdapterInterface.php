<?php

declare(strict_types=1);

namespace Component\Mailer\Sender\Adapter;

use Component\Mailer\Model\EmailInterface;
use Component\Mailer\Renderer\RenderedEmail;

interface AdapterInterface
{
    /**
     * @param array  $recipients
     * @param string $senderAddress
     * @param string $senderName
     * @param RenderedEmail $renderedEmail
     * @param EmailInterface $email
     * @param array $data
     * @param array $attachments
     * @param array $replyTo
     */
    public function send(
        array $recipients,
        string $senderAddress,
        string $senderName,
        RenderedEmail $renderedEmail,
        EmailInterface $email,
        array $data,
        array $attachments = [],
        array $replyTo = []
    ): void;
}
