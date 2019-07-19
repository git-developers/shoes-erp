<?php

declare(strict_types=1);

namespace spec\Component\User\Model;

use PhpSpec\ObjectBehavior;
use Component\User\Model\UserOAuthInterface;

final class UserOAuthSpec extends ObjectBehavior
{
    function it_implements_user_oauth_interface(): void
    {
        $this->shouldImplement(UserOAuthInterface::class);
    }
}
