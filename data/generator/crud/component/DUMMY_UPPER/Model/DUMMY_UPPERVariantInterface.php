<?php

declare(strict_types=1);

namespace Component\DUMMY_UPPER\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface DUMMY_UPPERVariantInterface extends
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
     * @return Collection|DUMMY_UPPEROptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param DUMMY_UPPEROptionValueInterface $optionValue
     */
    public function addOptionValue(DUMMY_UPPEROptionValueInterface $optionValue): void;

    /**
     * @param DUMMY_UPPEROptionValueInterface $optionValue
     */
    public function removeOptionValue(DUMMY_UPPEROptionValueInterface $optionValue): void;

    /**
     * @param DUMMY_UPPEROptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(DUMMY_UPPEROptionValueInterface $optionValue): bool;

    /**
     * @return DUMMY_UPPERInterface|null
     */
    public function getDUMMY_UPPER(): ?DUMMY_UPPERInterface;

    /**
     * @param DUMMY_UPPERInterface|null $DUMMY_UPPER
     */
    public function setDUMMY_UPPER(?DUMMY_UPPERInterface $DUMMY_UPPER): void;

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
     * @return DUMMY_UPPERVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
