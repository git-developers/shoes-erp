<?php

declare(strict_types=1);

namespace Component\Mailer\Renderer\Adapter;

use Component\Mailer\Model\EmailInterface;
use Component\Mailer\Renderer\RenderedEmail;

interface AdapterInterface
{
    /**
     * @param EmailInterface $email
     * @param array $data
     *
     * @return RenderedEmail
     */
    public function render(EmailInterface $email, array $data = []): RenderedEmail;
}
