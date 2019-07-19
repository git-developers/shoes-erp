<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Google\View;

use Bundle\ResourceBundle\Controller\ParametersParserInterface;
use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Component\Google\Data\DataProviderInterface;
use Component\Google\Definition\Google;
use Component\Google\Parameters;
use Component\Resource\Metadata\MetadataInterface;

final class ResourceTreeGoogleViewFactory implements ResourceTreeGoogleViewFactoryInterface
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
        Google $grid,
        Parameters $parameters,
        MetadataInterface $metadata,
        RequestConfiguration $requestConfiguration
    ): ResourceTreeGoogleView {
        $driverConfiguration = $grid->getDriverConfiguration();
        $request = $requestConfiguration->getRequest();

        $grid->setDriverConfiguration($this->parametersParser->parseRequestValues($driverConfiguration, $request));

        return new ResourceTreeGoogleView($this->dataProvider->getData($grid, $parameters), $grid, $parameters, $metadata, $requestConfiguration);
    }
}
