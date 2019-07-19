<?php

declare(strict_types=1);

namespace Component\Role\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface RoleOptionInterface extends
    ResourceInterface,
    CodeAwareInterface,
    TimestampableInterface,
    TranslatableInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;

    /**
     * @return int
     */
    public function getPosition(): ?int;

    /**
     * @param int $position
     */
    public function setPosition(?int $position): void;

    /**
     * @return Collection|RoleOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param RoleOptionValueInterface $optionValue
     */
    public function addValue(RoleOptionValueInterface $optionValue): void;

    /**
     * @param RoleOptionValueInterface $optionValue
     */
    public function removeValue(RoleOptionValueInterface $optionValue): void;

    /**
     * @param RoleOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(RoleOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return RoleOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
