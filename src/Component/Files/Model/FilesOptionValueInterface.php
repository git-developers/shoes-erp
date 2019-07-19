<?php

declare(strict_types=1);

namespace Component\Files\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface FilesOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return FilesOptionInterface
     */
    public function getOption(): ?FilesOptionInterface;

    /**
     * @param FilesOptionInterface $option
     */
    public function setOption(?FilesOptionInterface $option): void;

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
     * @return FilesOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
