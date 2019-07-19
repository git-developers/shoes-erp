<?php

declare(strict_types=1);

namespace Component\User\Model;

interface CredentialsHolderInterface
{
    /**
     * @return string|null
     */
    public function getPlainPassword();

    /**
     * @param string|null $plainPassword
     */
    public function setPlainPassword(string $plainPassword);

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string|null
     */
    public function getPassword();

    /**
     * @param string|null $encodedPassword
     */
    public function setPassword(string $encodedPassword);

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null
     */
    public function getSalt();

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials();
}
