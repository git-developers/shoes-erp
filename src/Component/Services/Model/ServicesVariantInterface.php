<?php

declare(strict_types=1);

namespace Component\Services\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ServicesVariantInterface extends
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
     * @return Collection|ServicesOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param ServicesOptionValueInterface $optionValue
     */
    public function addOptionValue(ServicesOptionValueInterface $optionValue): void;

    /**
     * @param ServicesOptionValueInterface $optionValue
     */
    public function removeOptionValue(ServicesOptionValueInterface $optionValue): void;

    /**
     * @param ServicesOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(ServicesOptionValueInterface $optionValue): bool;

    /**
     * @return ServicesInterface|null
     */
    public function getServices(): ?ServicesInterface;

    /**
     * @param ServicesInterface|null $Services
     */
    public function setServices(?ServicesInterface $Services): void;

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
     * @return ServicesVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
