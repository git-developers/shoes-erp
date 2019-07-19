<?php

declare(strict_types=1);

namespace Component\Route\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface RouteVariantInterface extends
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
     * @return Collection|RouteOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param RouteOptionValueInterface $optionValue
     */
    public function addOptionValue(RouteOptionValueInterface $optionValue): void;

    /**
     * @param RouteOptionValueInterface $optionValue
     */
    public function removeOptionValue(RouteOptionValueInterface $optionValue): void;

    /**
     * @param RouteOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(RouteOptionValueInterface $optionValue): bool;

    /**
     * @return RouteInterface|null
     */
    public function getRoute(): ?RouteInterface;

    /**
     * @param RouteInterface|null $Route
     */
    public function setRoute(?RouteInterface $Route): void;

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
     * @return RouteVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
