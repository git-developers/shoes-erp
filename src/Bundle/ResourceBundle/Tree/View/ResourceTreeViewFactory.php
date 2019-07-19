<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Tree\View;

use Bundle\ResourceBundle\Controller\ParametersParserInterface;
use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Component\Tree\Data\DataProviderInterface;
use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;
use Component\Resource\Metadata\MetadataInterface;

final class ResourceTreeViewFactory implements ResourceTreeViewFactoryInterface
{
    /**
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * @var ParametersParserInterface
     */
    private $parametersParser;

    /**
     * @param DataProviderInterface $dataProvider
     * @param ParametersParserInterface $parametersParser
     */
    public function __construct(DataProviderInterface $dataProvider, ParametersParserInterface $parametersParser)
    {
        $this->dataProvider = $dataProvider;
        $this->parametersParser = $parametersParser;
    }

    /**
     * {@inheritdoc}
     */
    public function create(
        Tree $grid,
        Parameters $parameters,
        MetadataInterface $metadata,
        RequestConfiguration $requestConfiguration
    ): ResourceTreeView {
        $driverConfiguration = $grid->getDriverConfiguration();
        $request = $requestConfiguration->getRequest();

        $grid->setDriverConfiguration($this->parametersParser->parseRequestValues($driverConfiguration, $request));

        return new ResourceTreeView($this->dataProvider->getData($grid, $parameters), $grid, $parameters, $metadata, $requestConfiguration);
    }
}
