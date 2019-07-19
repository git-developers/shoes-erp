<?php

declare(strict_types=1);

namespace Component\Image\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ImageOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return ImageOptionInterface
     */
    public function getOption(): ?ImageOptionInterface;

    /**
     * @param ImageOptionInterface $option
     */
    public function setOption(?ImageOptionInterface $option): void;

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
     * @return ImageOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
