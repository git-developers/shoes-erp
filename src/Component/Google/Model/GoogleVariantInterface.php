<?php

declare(strict_types=1);

namespace Component\Google\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GoogleVariantInterface extends
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
     * @return Collection|GoogleOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param GoogleOptionValueInterface $optionValue
     */
    public function addOptionValue(GoogleOptionValueInterface $optionValue): void;

    /**
     * @param GoogleOptionValueInterface $optionValue
     */
    public function removeOptionValue(GoogleOptionValueInterface $optionValue): void;

    /**
     * @param GoogleOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(GoogleOptionValueInterface $optionValue): bool;

    /**
     * @return GoogleInterface|null
     */
    public function getGoogle(): ?GoogleInterface;

    /**
     * @param GoogleInterface|null $Google
     */
    public function setGoogle(?GoogleInterface $Google): void;

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
     * @return GoogleVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
