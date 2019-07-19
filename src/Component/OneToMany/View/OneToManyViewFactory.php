<?php

declare(strict_types=1);

namespace Component\OneToMany\View;

use Component\OneToMany\Data\DataProviderInterface;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;

final class OneToManyViewFactory implements OneToManyViewFactoryInterface
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
    public function create(OneToMany $grid, Parameters $parameters): OneToManyViewInterface
    {
        return new OneToManyView($this->dataProvider->getData($grid, $parameters), $grid, $parameters);
    }
}
