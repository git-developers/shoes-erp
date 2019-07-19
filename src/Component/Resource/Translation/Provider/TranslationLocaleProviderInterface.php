<?php

declare(strict_types=1);

namespace Component\Resource\Translation\Provider;

interface TranslationLocaleProviderInterface
{
    /**
     * @return string[]
     */
    public function getDefinedLocalesCodes(): array;

    /**
     * @return string
     */
    public function getDefaultLocaleCode(): string;
}
