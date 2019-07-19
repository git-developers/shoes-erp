<?php

declare(strict_types=1);

namespace Component\Role\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface RoleVariantInterface extends
    TimestampableInterface,
    ResourceInterface,
    CodeAwareInterface,
    TranslatableInterface
{
    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * @return string
     */
    public function getDescriptor(): string;

    /**
     * @return Collection|RoleOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param RoleOptionValueInterface $optionValue
     */
    public function addOptionValue(RoleOptionValueInterface $optionValue): void;

    /**
     * @param RoleOptionValueInterface $optionValue
     */
    public function removeOptionValue(RoleOptionValueInterface $optionValue): void;

    /**
     * @param RoleOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(RoleOptionValueInterface $optionValue): bool;

    /**
     * @return RoleInterface|null
     */
    public function getRole(): ?RoleInterface;

    /**
     * @param RoleInterface|null $Role
     */
    public function setRole(?RoleInterface $Role): void;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void;

    /**
     * @param string|null $locale
     *
     * @return RoleVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
