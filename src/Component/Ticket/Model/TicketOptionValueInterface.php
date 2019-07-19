<?php

declare(strict_types=1);

namespace Component\Ticket\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface TicketOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return TicketOptionInterface
     */
    public function getOption(): ?TicketOptionInterface;

    /**
     * @param TicketOptionInterface $option
     */
    public function setOption(?TicketOptionInterface $option): void;

    /**
     * @return string|null
     */
    public function getValue(): ?string;

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void;

    /**
     * @return string|null
     */
    public function getOptionCode(): ?string;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $locale
     *
     * @return TicketOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
