<?php

declare(strict_types=1);

namespace Component\Visit\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface VisitOptionInterface extends
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
     * @return Collection|VisitOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param VisitOptionValueInterface $optionValue
     */
    public function addValue(VisitOptionValueInterface $optionValue): void;

    /**
     * @param VisitOptionValueInterface $optionValue
     */
    public function removeValue(VisitOptionValueInterface $optionValue): void;

    /**
     * @param VisitOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(VisitOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return VisitOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
