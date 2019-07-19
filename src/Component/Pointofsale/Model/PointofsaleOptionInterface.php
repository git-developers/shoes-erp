<?php

declare(strict_types=1);

namespace Component\Pointofsale\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface PointofsaleOptionInterface extends
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
     * @return Collection|PointofsaleOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param PointofsaleOptionValueInterface $optionValue
     */
    public function addValue(PointofsaleOptionValueInterface $optionValue): void;

    /**
     * @param PointofsaleOptionValueInterface $optionValue
     */
    public function removeValue(PointofsaleOptionValueInterface $optionValue): void;

    /**
     * @param PointofsaleOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(PointofsaleOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return PointofsaleOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
