<?php

declare(strict_types=1);

namespace Component\Order\View;

use Component\Order\Data\DataProviderInterface;
use Component\Order\Definition\Order;
use Component\Order\Parameters;

final class OrderViewFactory implements OneToManyViewFactoryInterface
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
    public function create(Order $grid, Parameters $parameters): OneToManyViewInterface
    {
        return new OneToManyView($this->dataProvider->getData($grid, $parameters), $grid, $parameters);
    }
}
