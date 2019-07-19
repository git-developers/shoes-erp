<?php

declare(strict_types=1);

namespace Component\Mailer\Provider;

use Component\Mailer\Model\EmailInterface;

interface EmailProviderInterface
{
    /**
     * @param string $code
     *
     * @return EmailInterface
     */
    public function getEmail(string $code): EmailInterface;
}
