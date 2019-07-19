<?php

declare(strict_types=1);

namespace Component\Session\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface SessionOptionInterface extends
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
     * @return Collection|SessionOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param SessionOptionValueInterface $optionValue
     */
    public function addValue(SessionOptionValueInterface $optionValue): void;

    /**
     * @param SessionOptionValueInterface $optionValue
     */
    public function removeValue(SessionOptionValueInterface $optionValue): void;

    /**
     * @param SessionOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(SessionOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return SessionOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
