<?php

declare(strict_types=1);

namespace Component\Attribute\Model;

use Doctrine\Common\Collections\Collection;

interface AttributeSubjectInterface
{
    /**
     * @return Collection|AttributeValueInterface[]
     */
    public function getAttributes(): Collection;

    /**
     * @param string $localeCode
     * @param string $fallbackLocaleCode
     * @param string|null $baseLocaleCode
     *
     * @return Collection|AttributeValueInterface[]
     */
    public function getAttributesByLocale(
        string $localeCode,
        string $fallbackLocaleCode,
        ?string $baseLocaleCode = null
    ): Collection;

    /**
     * @param AttributeValueInterface $attribute
     */
    public function addAttribute(AttributeValueInterface $attribute): void;

    /**
     * @param AttributeValueInterface $attribute
     */
    public function removeAttribute(AttributeValueInterface $attribute): void;

    /**
     * @param AttributeValueInterface $attribute
     *
     * @return bool
     */
    public function hasAttribute(AttributeValueInterface $attribute): bool;

    /**
     * @param string $attributeCode
     * @param string|null $localeCode
     *
     * @return bool
     */
    public function hasAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): bool;

    /**
     * @param string $attributeCode
     * @param string|null $localeCode
     *
     * @return AttributeValueInterface|null
     */
    public function getAttributeByCodeAndLocale(string $attributeCode, ?string $localeCode = null): ?AttributeValueInterface;
}
