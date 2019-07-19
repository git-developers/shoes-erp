<?php

declare(strict_types=1);

namespace Component\Ticket\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface TicketVariantInterface extends
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
     * @return Collection|TicketOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param TicketOptionValueInterface $optionValue
     */
    public function addOptionValue(TicketOptionValueInterface $optionValue): void;

    /**
     * @param TicketOptionValueInterface $optionValue
     */
    public function removeOptionValue(TicketOptionValueInterface $optionValue): void;

    /**
     * @param TicketOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(TicketOptionValueInterface $optionValue): bool;

    /**
     * @return TicketInterface|null
     */
    public function getTicket(): ?TicketInterface;

    /**
     * @param TicketInterface|null $Ticket
     */
    public function setTicket(?TicketInterface $Ticket): void;

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
     * @return TicketVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
