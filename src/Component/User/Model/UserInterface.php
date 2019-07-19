<?php

declare(strict_types=1);

namespace Component\User\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

interface UserInterface extends
    AdvancedUserInterface,
    CredentialsHolderInterface,
    ResourceInterface,
    \Serializable,
    TimestampableInterface,
    ToggleableInterface
{
    public const DEFAULT_ROLE = 'ROLE_USER';

    /**
     * @return string|null
     */
    public function getEmail();

    /**
     * @param string|null $email
     */
    public function setEmail(string $email);

    /**
     * Gets normalized email (should be used in search and sort queries).
     *
     * @return string|null
     */
    public function getEmailCanonical();

    /**
     * @param string|null $emailCanonical
     */
    public function setEmailCanonical(string $emailCanonical);

    /**
     * @param string|null $username
     */
    public function setUsername(string $username);

    /**
     * Gets normalized username (should be used in search and sort queries).
     *
     * @return string|null
     */
    public function getUsernameCanonical();

    /**
     * @param string|null $usernameCanonical
     */
    public function setUsernameCanonical(string $usernameCanonical);

    /**
     * @param bool $locked
     */
    public function setLocked(bool $locked);

    /**
     * @return string|null
     */
    public function getEmailVerificationToken();

    /**
     * @param string|null $verificationToken
     */
    public function setEmailVerificationToken(string $verificationToken);

    /**
     * @return string|null
     */
    public function getPasswordResetToken();

    /**
     * @param string|null $passwordResetToken
     */
    public function setPasswordResetToken(string $passwordResetToken);

    /**
     * @return \DateTimeInterface|null
     */
    public function getPasswordRequestedAt();

    /**
     * @param \DateTimeInterface|null $date
     */
    public function setPasswordRequestedAt(\DateTimeInterface $date);

    /**
     * @param \DateInterval $ttl
     *
     * @return bool
     */
    public function isPasswordRequestNonExpired(\DateInterval $ttl);

    /**
     * @return bool
     */
    public function isVerified();

    /**
     * @return \DateTimeInterface|null
     */
    public function getVerifiedAt();

    /**
     * @param \DateTimeInterface|null $verifiedAt
     */
    public function setVerifiedAt(\DateTimeInterface $verifiedAt);

    /**
     * @return \DateTimeInterface|null
     */
    public function getExpiresAt();

    /**
     * @param \DateTimeInterface|null $date
     */
    public function setExpiresAt(\DateTimeInterface $date);

    /**
     * @return \DateTimeInterface|null
     */
    public function getCredentialsExpireAt();

    /**
     * @param \DateTimeInterface|null $date
     */
    public function setCredentialsExpireAt(\DateTimeInterface $date);

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastLogin();

    /**
     * @param \DateTimeInterface|null $time
     */
    public function setLastLogin(\DateTimeInterface $time);

    /**
     * Never use this to check if this user has access to anything!
     *
     * Use the SecurityContext, or an implementation of AccessDecisionManager
     * instead, e.g.
     *
     *         $securityContext->isGranted('ROLE_USER');
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role);

    /**
     * @param string $role
     */
    public function addRole(string $role);

    /**
     * @param string $role
     */
    public function removeRole(string $role);

    /**
     * @return Collection|UserOAuthInterface[]
     */
    public function getOAuthAccounts();

    /**
     * @param string $provider
     *
     * @return UserOAuthInterface|null
     */
    public function getOAuthAccount(string $provider);

    /**
     * @param UserOAuthInterface $oauth
     */
    public function addOAuthAccount(UserOAuthInterface $oauth);
}
