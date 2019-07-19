<?php

declare(strict_types=1);

namespace Component\Resource\Model;

class AbstractTranslation implements TranslationInterface
{
    /**
     * @var string|null
     */
    protected $locale;

    /**
     * @var TranslatableInterface|null
     */
    protected $translatable;

    /**
     * {@inheritdoc}
     */
    public function getTranslatable(): TranslatableInterface
    {
        return $this->translatable;
    }

    /**
     * {@inheritdoc}
     */
    public function setTranslatable(?TranslatableInterface $translatable): void
    {
        if ($translatable === $this->translatable) {
            return;
        }

        $previousTranslatable = $this->translatable;
        $this->translatable = $translatable;

        if (null !== $previousTranslatable) {
            $previousTranslatable->removeTranslation($this);
        }

        if (null !== $translatable) {
            $translatable->addTranslation($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale(?string $locale): void
    {
        $this->locale = $locale;
    }
}
