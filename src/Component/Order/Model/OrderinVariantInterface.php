<?php

declare(strict_types=1);

namespace Component\Order\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface OrderinVariantInterface extends
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
     * @return Collection|OrderinOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param OrderinOptionValueInterface $optionValue
     */
    public function addOptionValue(OrderinOptionValueInterface $optionValue): void;

    /**
     * @param OrderinOptionValueInterface $optionValue
     */
    public function removeOptionValue(OrderinOptionValueInterface $optionValue): void;

    /**
     * @param OrderinOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(OrderinOptionValueInterface $optionValue): bool;

    /**
     * @return OrderinInterface|null
     */
    public function getOrderin(): ?OrderinInterface;

    /**
     * @param OrderinInterface|null $Orderin
     */
    public function setOrderin(?OrderinInterface $Orderin): void;

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
     * @return OrderinVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
