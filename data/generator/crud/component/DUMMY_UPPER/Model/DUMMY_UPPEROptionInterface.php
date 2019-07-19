<?php

declare(strict_types=1);

namespace Component\DUMMY_UPPER\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface DUMMY_UPPEROptionInterface extends
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
     * @return Collection|DUMMY_UPPEROptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param DUMMY_UPPEROptionValueInterface $optionValue
     */
    public function addValue(DUMMY_UPPEROptionValueInterface $optionValue): void;

    /**
     * @param DUMMY_UPPEROptionValueInterface $optionValue
     */
    public function removeValue(DUMMY_UPPEROptionValueInterface $optionValue): void;

    /**
     * @param DUMMY_UPPEROptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(DUMMY_UPPEROptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return DUMMY_UPPEROptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
