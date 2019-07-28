<?php

declare(strict_types=1);

namespace Component\Settings\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class SettingsAssociation implements SettingsAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var SettingsAssociationTypeInterface
     */
    protected $type;

    /**
     * @var SettingsInterface
     */
    protected $owner;

    /**
     * @var Collection|SettingsInterface[]
     */
    protected $associatedSettingss;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedSettingss = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ?SettingsAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?SettingsAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?SettingsInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?SettingsInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedSettingss(): Collection
    {
        return $this->associatedSettingss;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedSettings(SettingsInterface $Settings): bool
    {
        return $this->associatedSettingss->contains($Settings);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedSettings(SettingsInterface $Settings): void
    {
        if (!$this->hasAssociatedSettings($Settings)) {
            $this->associatedSettingss->add($Settings);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedSettings(SettingsInterface $Settings): void
    {
        if ($this->hasAssociatedSettings($Settings)) {
            $this->associatedSettingss->removeElement($Settings);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedSettingss(): void
    {
        $this->associatedSettingss->clear();
    }
}
