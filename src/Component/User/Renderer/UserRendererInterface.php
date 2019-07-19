<?php

declare(strict_types=1);

namespace Component\User\Renderer;
use Bundle\UserBundle\Entity\User;

interface UserRendererInterface
{

    // JAFETH
    public function profileAboutMe(string $aboutMe = null);
    public function appUserName(User $user, $start, $length = null);

}
