<?php

declare(strict_types=1);

namespace Component\Module\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ModuleVariantInterface extends
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
     * @return Collection|ModuleOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param ModuleOptionValueInterface $optionValue
     */
    public function addOptionValue(ModuleOptionValueInterface $optionValue): void;

    /**
     * @param ModuleOptionValueInterface $optionValue
     */
    public function removeOptionValue(ModuleOptionValueInterface $optionValue): void;

    /**
     * @param ModuleOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(ModuleOptionValueInterface $optionValue): bool;

    /**
     * @return ModuleInterface|null
     */
    public function getModule(): ?ModuleInterface;

    /**
     * @param ModuleInterface|null $Module
     */
    public function setModule(?ModuleInterface $Module): void;

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
     * @return ModuleVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
