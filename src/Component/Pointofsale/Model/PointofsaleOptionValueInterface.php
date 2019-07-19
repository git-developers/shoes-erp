<?php

declare(strict_types=1);

namespace Component\Pointofsale\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface PointofsaleOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return PointofsaleOptionInterface
     */
    public function getOption(): ?PointofsaleOptionInterface;

    /**
     * @param PointofsaleOptionInterface $option
     */
    public function setOption(?PointofsaleOptionInterface $option): void;

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
     * @return PointofsaleOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
