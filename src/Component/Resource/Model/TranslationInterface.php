<?php

declare(strict_types=1);

namespace Component\Resource\Model;

interface TranslationInterface
{
    /**
     * @return TranslatableInterface
     */
    public function getTranslatable(): TranslatableInterface;

    /**
     * @param TranslatableInterface|null $translatable
     */
    public function setTranslatable(?TranslatableInterface $translatable): void;

    /**
     * @return string|null
     */
    public function getLocale(): ?string;

    /**
     * @param string|null $locale
     */
    public function setLocale(?string $locale): void;
}
