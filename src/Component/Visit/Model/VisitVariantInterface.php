<?php

declare(strict_types=1);

namespace Component\Visit\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface VisitVariantInterface extends
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
     * @return Collection|VisitOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param VisitOptionValueInterface $optionValue
     */
    public function addOptionValue(VisitOptionValueInterface $optionValue): void;

    /**
     * @param VisitOptionValueInterface $optionValue
     */
    public function removeOptionValue(VisitOptionValueInterface $optionValue): void;

    /**
     * @param VisitOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(VisitOptionValueInterface $optionValue): bool;

    /**
     * @return VisitInterface|null
     */
    public function getVisit(): ?VisitInterface;

    /**
     * @param VisitInterface|null $Visit
     */
    public function setVisit(?VisitInterface $Visit): void;

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
     * @return VisitVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
