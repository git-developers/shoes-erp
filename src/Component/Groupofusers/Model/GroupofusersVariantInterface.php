<?php

declare(strict_types=1);

namespace Component\Groupofusers\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GroupofusersVariantInterface extends
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
     * @return Collection|GroupofusersOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param GroupofusersOptionValueInterface $optionValue
     */
    public function addOptionValue(GroupofusersOptionValueInterface $optionValue): void;

    /**
     * @param GroupofusersOptionValueInterface $optionValue
     */
    public function removeOptionValue(GroupofusersOptionValueInterface $optionValue): void;

    /**
     * @param GroupofusersOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(GroupofusersOptionValueInterface $optionValue): bool;

    /**
     * @return GroupofusersInterface|null
     */
    public function getGroupofusers(): ?GroupofusersInterface;

    /**
     * @param GroupofusersInterface|null $Groupofusers
     */
    public function setGroupofusers(?GroupofusersInterface $Groupofusers): void;

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
     * @return GroupofusersVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
