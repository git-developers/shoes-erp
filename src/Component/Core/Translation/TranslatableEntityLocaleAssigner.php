<?php

declare(strict_types=1);

namespace Component\Resource\Translation;

use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;

final class TranslatableEntityLocaleAssigner implements TranslatableEntityLocaleAssignerInterface
{
    /**
     * @var TranslationLocaleProviderInterface
     */
    private $translationLocaleProvider;

    /**
     * @param TranslationLocaleProviderInterface $translationLocaleProvider
     */
    public function __construct(TranslationLocaleProviderInterface $translationLocaleProvider)
    {
        $this->translationLocaleProvider = $translationLocaleProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function assignLocale(TranslatableInterface $translatableEntity): void
    {
        $localeCode = $this->translationLocaleProvider->getDefaultLocaleCode();

        $translatableEntity->setCurrentLocale($localeCode);
        $translatableEntity->setFallbackLocale($localeCode);
    }
}
