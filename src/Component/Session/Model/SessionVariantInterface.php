<?php

declare(strict_types=1);

namespace Component\Session\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface SessionVariantInterface extends
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
     * @return Collection|SessionOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param SessionOptionValueInterface $optionValue
     */
    public function addOptionValue(SessionOptionValueInterface $optionValue): void;

    /**
     * @param SessionOptionValueInterface $optionValue
     */
    public function removeOptionValue(SessionOptionValueInterface $optionValue): void;

    /**
     * @param SessionOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(SessionOptionValueInterface $optionValue): bool;

    /**
     * @return SessionInterface|null
     */
    public function getSession(): ?SessionInterface;

    /**
     * @param SessionInterface|null $Session
     */
    public function setSession(?SessionInterface $Session): void;

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
     * @return SessionVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
