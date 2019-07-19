<?php

declare(strict_types=1);

namespace Component\Report\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ReportVariantInterface extends
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
     * @return Collection|ReportOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param ReportOptionValueInterface $optionValue
     */
    public function addOptionValue(ReportOptionValueInterface $optionValue): void;

    /**
     * @param ReportOptionValueInterface $optionValue
     */
    public function removeOptionValue(ReportOptionValueInterface $optionValue): void;

    /**
     * @param ReportOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(ReportOptionValueInterface $optionValue): bool;

    /**
     * @return ReportInterface|null
     */
    public function getReport(): ?ReportInterface;

    /**
     * @param ReportInterface|null $Report
     */
    public function setReport(?ReportInterface $Report): void;

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
     * @return ReportVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
