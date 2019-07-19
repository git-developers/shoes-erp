<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\View;

use Component\TreeOneToMany\Data\DataProviderInterface;
use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Parameters;

final class TreeOneToManyViewFactory implements TreeOneToManyViewFactoryInterface
{
    /**
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function create(TreeOneToMany $grid, Parameters $parameters): TreeOneToManyViewInterface
    {
        return new TreeOneToManyView($this->dataProvider->getData($grid, $parameters), $grid, $parameters);
    }
}
