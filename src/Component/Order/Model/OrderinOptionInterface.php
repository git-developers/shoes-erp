<?php

declare(strict_types=1);

namespace Component\Order\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface OrderinOptionInterface extends
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
     * @return Collection|OrderinOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param OrderinOptionValueInterface $optionValue
     */
    public function addValue(OrderinOptionValueInterface $optionValue): void;

    /**
     * @param OrderinOptionValueInterface $optionValue
     */
    public function removeValue(OrderinOptionValueInterface $optionValue): void;

    /**
     * @param OrderinOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(OrderinOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return OrderinOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
