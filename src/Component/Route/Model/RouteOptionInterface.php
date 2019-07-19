<?php

declare(strict_types=1);

namespace Component\Route\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface RouteOptionInterface extends
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
     * @return Collection|RouteOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param RouteOptionValueInterface $optionValue
     */
    public function addValue(RouteOptionValueInterface $optionValue): void;

    /**
     * @param RouteOptionValueInterface $optionValue
     */
    public function removeValue(RouteOptionValueInterface $optionValue): void;

    /**
     * @param RouteOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(RouteOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return RouteOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
