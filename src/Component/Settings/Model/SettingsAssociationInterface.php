<?php

declare(strict_types=1);

namespace Component\Settings\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface SettingsAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return SettingsAssociationTypeInterface|null
     */
    public function getType(): ?SettingsAssociationTypeInterface;

    /**
     * @param SettingsAssociationTypeInterface|null $type
     */
    public function setType(?SettingsAssociationTypeInterface $type): void;

    /**
     * @return SettingsInterface|null
     */
    public function getOwner(): ?SettingsInterface;

    /**
     * @param SettingsInterface|null $owner
     */
    public function setOwner(?SettingsInterface $owner): void;

    /**
     * @return Collection|SettingsInterface[]
     */
    public function getAssociatedSettingss(): Collection;

    /**
     * @param SettingsInterface $Settings
     */
    public function addAssociatedSettings(SettingsInterface $Settings): void;

    /**
     * @param SettingsInterface $Settings
     */
    public function removeAssociatedSettings(SettingsInterface $Settings): void;

    /**
     * @param SettingsInterface $Settings
     *
     * @return bool
     */
    public function hasAssociatedSettings(SettingsInterface $Settings): bool;

    public function clearAssociatedSettingss(): void;
}
