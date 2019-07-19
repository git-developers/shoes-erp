<?php

declare(strict_types=1);

namespace Component\DUMMY_UPPER\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface DUMMY_UPPEROptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return DUMMY_UPPEROptionInterface
     */
    public function getOption(): ?DUMMY_UPPEROptionInterface;

    /**
     * @param DUMMY_UPPEROptionInterface $option
     */
    public function setOption(?DUMMY_UPPEROptionInterface $option): void;

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
     * @return DUMMY_UPPEROptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
