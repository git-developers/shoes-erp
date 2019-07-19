<?php

declare(strict_types=1);

namespace Component\Session\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface SessionOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return SessionOptionInterface
     */
    public function getOption(): ?SessionOptionInterface;

    /**
     * @param SessionOptionInterface $option
     */
    public function setOption(?SessionOptionInterface $option): void;

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
     * @return SessionOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
