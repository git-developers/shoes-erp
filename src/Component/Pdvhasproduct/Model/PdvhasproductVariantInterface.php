<?php

declare(strict_types=1);

namespace Component\Pdvhasproduct\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface PdvhasproductVariantInterface extends
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
     * @return Collection|PdvhasproductOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param PdvhasproductOptionValueInterface $optionValue
     */
    public function addOptionValue(PdvhasproductOptionValueInterface $optionValue): void;

    /**
     * @param PdvhasproductOptionValueInterface $optionValue
     */
    public function removeOptionValue(PdvhasproductOptionValueInterface $optionValue): void;

    /**
     * @param PdvhasproductOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(PdvhasproductOptionValueInterface $optionValue): bool;

    /**
     * @return PdvhasproductInterface|null
     */
    public function getPdvhasproduct(): ?PdvhasproductInterface;

    /**
     * @param PdvhasproductInterface|null $Pdvhasproduct
     */
    public function setPdvhasproduct(?PdvhasproductInterface $Pdvhasproduct): void;

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
     * @return PdvhasproductVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
