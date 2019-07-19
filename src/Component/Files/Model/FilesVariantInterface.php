<?php

declare(strict_types=1);

namespace Component\Files\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface FilesVariantInterface extends
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
     * @return Collection|FilesOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param FilesOptionValueInterface $optionValue
     */
    public function addOptionValue(FilesOptionValueInterface $optionValue): void;

    /**
     * @param FilesOptionValueInterface $optionValue
     */
    public function removeOptionValue(FilesOptionValueInterface $optionValue): void;

    /**
     * @param FilesOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(FilesOptionValueInterface $optionValue): bool;

    /**
     * @return FilesInterface|null
     */
    public function getFiles(): ?FilesInterface;

    /**
     * @param FilesInterface|null $Files
     */
    public function setFiles(?FilesInterface $Files): void;

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
     * @return FilesVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
