<?php

declare(strict_types=1);

namespace Component\Role\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface RoleOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return RoleOptionInterface
     */
    public function getOption(): ?RoleOptionInterface;

    /**
     * @param RoleOptionInterface $option
     */
    public function setOption(?RoleOptionInterface $option): void;

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
     * @return RoleOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
