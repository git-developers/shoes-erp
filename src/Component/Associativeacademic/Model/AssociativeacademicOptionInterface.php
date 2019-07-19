<?php

declare(strict_types=1);

namespace Component\Associativeacademic\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface AssociativeacademicOptionInterface extends
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
     * @return Collection|AssociativeacademicOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param AssociativeacademicOptionValueInterface $optionValue
     */
    public function addValue(AssociativeacademicOptionValueInterface $optionValue): void;

    /**
     * @param AssociativeacademicOptionValueInterface $optionValue
     */
    public function removeValue(AssociativeacademicOptionValueInterface $optionValue): void;

    /**
     * @param AssociativeacademicOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(AssociativeacademicOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return AssociativeacademicOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
