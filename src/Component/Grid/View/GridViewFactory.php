<?php

declare(strict_types=1);

namespace Component\Grid\View;

use Component\Grid\Data\DataProviderInterface;
use Component\Grid\Definition\Grid;
use Component\Grid\Parameters;

final class GridViewFactory implements GridViewFactoryInterface
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
    public function create(Grid $grid, Parameters $parameters): GridViewInterface
    {
        return new GridView($this->dataProvider->getData($grid, $parameters), $grid, $parameters);
    }
}
