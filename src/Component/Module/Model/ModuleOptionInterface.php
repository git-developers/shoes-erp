<?php

declare(strict_types=1);

namespace Component\Module\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ModuleOptionInterface extends
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
     * @return Collection|ModuleOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param ModuleOptionValueInterface $optionValue
     */
    public function addValue(ModuleOptionValueInterface $optionValue): void;

    /**
     * @param ModuleOptionValueInterface $optionValue
     */
    public function removeValue(ModuleOptionValueInterface $optionValue): void;

    /**
     * @param ModuleOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(ModuleOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return ModuleOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
