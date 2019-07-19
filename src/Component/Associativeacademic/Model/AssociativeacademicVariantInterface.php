<?php

declare(strict_types=1);

namespace Component\Associativeacademic\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface AssociativeacademicVariantInterface extends
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
     * @return Collection|AssociativeacademicOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param AssociativeacademicOptionValueInterface $optionValue
     */
    public function addOptionValue(AssociativeacademicOptionValueInterface $optionValue): void;

    /**
     * @param AssociativeacademicOptionValueInterface $optionValue
     */
    public function removeOptionValue(AssociativeacademicOptionValueInterface $optionValue): void;

    /**
     * @param AssociativeacademicOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(AssociativeacademicOptionValueInterface $optionValue): bool;

    /**
     * @return AssociativeacademicInterface|null
     */
    public function getAssociativeacademic(): ?AssociativeacademicInterface;

    /**
     * @param AssociativeacademicInterface|null $Associativeacademic
     */
    public function setAssociativeacademic(?AssociativeacademicInterface $Associativeacademic): void;

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
     * @return AssociativeacademicVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
