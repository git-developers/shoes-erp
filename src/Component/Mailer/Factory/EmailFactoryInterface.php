<?php

declare(strict_types=1);

namespace Component\Mailer\Factory;

use Component\Mailer\Model\EmailInterface;

interface EmailFactoryInterface
{
    /**
     * @return EmailInterface
     */
    public function createNew(): EmailInterface;
}
