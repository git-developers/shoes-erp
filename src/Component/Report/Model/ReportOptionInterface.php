<?php

declare(strict_types=1);

namespace Component\Report\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ReportOptionInterface extends
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
     * @return Collection|ReportOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param ReportOptionValueInterface $optionValue
     */
    public function addValue(ReportOptionValueInterface $optionValue): void;

    /**
     * @param ReportOptionValueInterface $optionValue
     */
    public function removeValue(ReportOptionValueInterface $optionValue): void;

    /**
     * @param ReportOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(ReportOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return ReportOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
