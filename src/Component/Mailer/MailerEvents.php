<?php

declare(strict_types=1);

namespace Component\Mailer;

class MailerEvents
{
    public const EMAIL_PRE_RENDER = 'sylius.email_rendered';
    public const EMAIL_PRE_SEND = 'sylius.email_send.pre_send';
    public const EMAIL_POST_SEND = 'sylius.email_send.post_send';
}
