<?php

declare(strict_types=1);

namespace Component\Mailer\Factory;

use Component\Mailer\Model\Email;
use Component\Mailer\Model\EmailInterface;

class EmailFactory implements EmailFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew(): EmailInterface
    {
        return new Email();
    }
}
