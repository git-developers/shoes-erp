<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Model;

final class ThemeAuthor
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $homepage;

    /**
     * @var string|null
     */
    private $role;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getHomepage()
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage)
    {
        $this->homepage = $homepage;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole(string $role)
    {
        $this->role = $role;
    }
}
