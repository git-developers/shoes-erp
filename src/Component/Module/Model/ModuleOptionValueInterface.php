<?php

declare(strict_types=1);

namespace Component\Module\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ModuleOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return ModuleOptionInterface
     */
    public function getOption(): ?ModuleOptionInterface;

    /**
     * @param ModuleOptionInterface $option
     */
    public function setOption(?ModuleOptionInterface $option): void;

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
     * @return ModuleOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
