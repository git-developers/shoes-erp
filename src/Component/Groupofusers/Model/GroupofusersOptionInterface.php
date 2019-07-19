<?php

declare(strict_types=1);

namespace Component\Groupofusers\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GroupofusersOptionInterface extends
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
     * @return Collection|GroupofusersOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param GroupofusersOptionValueInterface $optionValue
     */
    public function addValue(GroupofusersOptionValueInterface $optionValue): void;

    /**
     * @param GroupofusersOptionValueInterface $optionValue
     */
    public function removeValue(GroupofusersOptionValueInterface $optionValue): void;

    /**
     * @param GroupofusersOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(GroupofusersOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return GroupofusersOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
