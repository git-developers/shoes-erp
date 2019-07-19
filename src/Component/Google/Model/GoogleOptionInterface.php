<?php

declare(strict_types=1);

namespace Component\Google\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GoogleOptionInterface extends
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
     * @return Collection|GoogleOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param GoogleOptionValueInterface $optionValue
     */
    public function addValue(GoogleOptionValueInterface $optionValue): void;

    /**
     * @param GoogleOptionValueInterface $optionValue
     */
    public function removeValue(GoogleOptionValueInterface $optionValue): void;

    /**
     * @param GoogleOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(GoogleOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return GoogleOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
