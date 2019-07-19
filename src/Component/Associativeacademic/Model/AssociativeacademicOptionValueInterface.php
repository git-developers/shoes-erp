<?php

declare(strict_types=1);

namespace Component\Associativeacademic\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface AssociativeacademicOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return AssociativeacademicOptionInterface
     */
    public function getOption(): ?AssociativeacademicOptionInterface;

    /**
     * @param AssociativeacademicOptionInterface $option
     */
    public function setOption(?AssociativeacademicOptionInterface $option): void;

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
     * @return AssociativeacademicOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
