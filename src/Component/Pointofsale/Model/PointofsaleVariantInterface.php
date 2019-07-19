<?php

declare(strict_types=1);

namespace Component\Pointofsale\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface PointofsaleVariantInterface extends
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
     * @return Collection|PointofsaleOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param PointofsaleOptionValueInterface $optionValue
     */
    public function addOptionValue(PointofsaleOptionValueInterface $optionValue): void;

    /**
     * @param PointofsaleOptionValueInterface $optionValue
     */
    public function removeOptionValue(PointofsaleOptionValueInterface $optionValue): void;

    /**
     * @param PointofsaleOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(PointofsaleOptionValueInterface $optionValue): bool;

    /**
     * @return PointofsaleInterface|null
     */
    public function getPointofsale(): ?PointofsaleInterface;

    /**
     * @param PointofsaleInterface|null $Pointofsale
     */
    public function setPointofsale(?PointofsaleInterface $Pointofsale): void;

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
     * @return PointofsaleVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
