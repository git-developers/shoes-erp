<?php

declare(strict_types=1);

namespace Component\Profile\Model;

use Component\Resource\Model\TranslatableTrait;
use Component\Resource\Model\TranslationInterface;

class ProfileOptionValue implements ProfileOptionValueInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationCollection;
        getTranslation as private doGetTranslation;
    }

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var ProfileOptionInterface
     */
    protected $option;

    public function __construct()
    {
        $this->initializeTranslationCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * {@inheritdoc}
     */
    public function getOption(): ?ProfileOptionInterface
    {
        return $this->option;
    }

    /**
     * {@inheritdoc}
     */
    public function setOption(?ProfileOptionInterface $option): void
    {
        $this->option = $option;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): ?string
    {
        return $this->getTranslation()->getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(?string $value): void
    {
        $this->getTranslation()->setValue($value);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \BadMethodCallException
     */
    public function getOptionCode(): ?string
    {
        if (null === $this->option) {
            throw new \BadMethodCallException(
                'The option have not been created yet so you cannot access proxy methods.'
            );
        }

        return $this->option->getCode();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \BadMethodCallException
     */
    public function getName(): ?string
    {
        if (null === $this->option) {
            throw new \BadMethodCallException(
                'The option have not been created yet so you cannot access proxy methods.'
            );
        }

        return $this->option->getName();
    }

    /**
     * @param string|null $locale
     *
     * @return ProfileOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var ProfileOptionValueTranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): ProfileOptionValueTranslationInterface
    {
        return new ProfileOptionValueTranslation();
    }
}
