<?php

declare(strict_types=1);

namespace Component\OneToMany\View;

use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;
use Webmozart\Assert\Assert;

class OneToManyView implements OneToManyViewInterface
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @var OneToMany
     */
    private $definition;

    /**
     * @var Parameters
     */
    private $parameters;

    /**
     * @param mixed $data
     * @param OneToMany $definition
     * @param Parameters $parameters
     */
    public function __construct($data, OneToMany $definition, Parameters $parameters)
    {
        $this->data = $data;
        $this->definition = $definition;
        $this->parameters = $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefinition(): OneToMany
    {
        return $this->definition;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters(): Parameters
    {
        return $this->parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function getSortingOrder(string $fieldName): ?string
    {
        $this->assertFieldIsSortable($fieldName);

        $currentSorting = $this->getCurrentlySortedBy();

        if (array_key_exists($fieldName, $currentSorting)) {
            return $currentSorting[$fieldName];
        }

        $definedSorting = $this->definition->getSorting();

        return reset($definedSorting) ?: null;
    }

    /**
     * {@inheritdoc}
     */
    public function isSortedBy(string $fieldName): bool
    {
        $this->assertFieldIsSortable($fieldName);

        if ($this->parameters->has('sorting')) {
            return array_key_exists($fieldName, $this->parameters->get('sorting'));
        }

        $sortingDefinition = $this->getDefinition()->getSorting();
        $sortedFields = array_keys($sortingDefinition);

        return $fieldName === array_shift($sortedFields);
    }

    /**
     * @return array
     */
    private function getCurrentlySortedBy(): array
    {
        return $this->parameters->has('sorting')
            ? array_merge($this->definition->getSorting(), $this->parameters->get('sorting'))
            : $this->definition->getSorting()
        ;
    }

    /**
     * @param string $fieldName
     *
     * @throws \InvalidArgumentException
     */
    private function assertFieldIsSortable(string $fieldName): void
    {
        Assert::true($this->definition->hasField($fieldName), sprintf('Field "%s" does not exist.', $fieldName));
        Assert::true(
            $this->definition->getField($fieldName)->isSortable(),
            sprintf('Field "%s" is not sortable.', $fieldName)
        );
    }
}
