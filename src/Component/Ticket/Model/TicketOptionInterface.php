<?php

declare(strict_types=1);

namespace Component\Ticket\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface TicketOptionInterface extends
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
     * @return Collection|TicketOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param TicketOptionValueInterface $optionValue
     */
    public function addValue(TicketOptionValueInterface $optionValue): void;

    /**
     * @param TicketOptionValueInterface $optionValue
     */
    public function removeValue(TicketOptionValueInterface $optionValue): void;

    /**
     * @param TicketOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(TicketOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return TicketOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
