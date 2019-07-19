<?php

declare(strict_types=1);

namespace Component\Services\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ServicesOptionInterface extends
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
     * @return Collection|ServicesOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param ServicesOptionValueInterface $optionValue
     */
    public function addValue(ServicesOptionValueInterface $optionValue): void;

    /**
     * @param ServicesOptionValueInterface $optionValue
     */
    public function removeValue(ServicesOptionValueInterface $optionValue): void;

    /**
     * @param ServicesOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(ServicesOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return ServicesOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
