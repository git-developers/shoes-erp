<?php

declare(strict_types=1);

namespace Component\Tree\View;

use Component\Tree\Data\DataProviderInterface;
use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;

final class TreeViewFactory implements TreeViewFactoryInterface
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
    public function create(Tree $grid, Parameters $parameters): TreeViewInterface
    {
        return new TreeView($this->dataProvider->getData($grid, $parameters), $grid, $parameters);
    }
}
