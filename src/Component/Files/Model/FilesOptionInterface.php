<?php

declare(strict_types=1);

namespace Component\Files\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface FilesOptionInterface extends
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
     * @return Collection|FilesOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param FilesOptionValueInterface $optionValue
     */
    public function addValue(FilesOptionValueInterface $optionValue): void;

    /**
     * @param FilesOptionValueInterface $optionValue
     */
    public function removeValue(FilesOptionValueInterface $optionValue): void;

    /**
     * @param FilesOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(FilesOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return FilesOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
