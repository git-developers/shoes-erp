<?php

declare(strict_types=1);

namespace Component\Google\View;

use Component\Google\Data\DataProviderInterface;
use Component\Google\Definition\Google;
use Component\Google\Parameters;

final class GoogleViewFactory implements GoogleViewFactoryInterface
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
    public function create(Google $grid, Parameters $parameters): GoogleViewInterface
    {
        return new GoogleView($this->dataProvider->getData($grid, $parameters), $grid, $parameters);
    }
}
