<?php

declare(strict_types=1);

namespace Component\Resource\Translation\Provider;

final class ImmutableTranslationLocaleProvider implements TranslationLocaleProviderInterface
{
    /**
     * @var array
     */
    private $definedLocalesCodes;

    /**
     * @var string
     */
    private $defaultLocaleCode;

    /**
     * @param array $definedLocalesCodes
     * @param string $defaultLocaleCode
     */
    public function __construct(array $definedLocalesCodes, string $defaultLocaleCode)
    {
        $this->definedLocalesCodes = $definedLocalesCodes;
        $this->defaultLocaleCode = $defaultLocaleCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefinedLocalesCodes(): array
    {
        return $this->definedLocalesCodes;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultLocaleCode(): string
    {
        return $this->defaultLocaleCode;
    }
}
