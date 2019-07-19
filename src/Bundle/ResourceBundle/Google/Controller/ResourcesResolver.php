<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Google\Controller;

use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Bundle\ResourceBundle\Controller\ResourcesResolverInterface;
use Bundle\ResourceBundle\Google\View\ResourceTreeGoogleViewFactoryInterface;
use Component\Google\Parameters;
use Component\Google\Provider\GoogleProviderInterface;
use Component\Resource\Repository\RepositoryInterface;

final class ResourcesResolver implements ResourcesResolverInterface
{
    /**
     * @var ResourcesResolverInterface
     */
    private $decoratedResolver;

    /**
     * @var GoogleProviderInterface
     */
    private $gridProvider;

    /**
     * @var ResourceTreeGoogleViewFactoryInterface
     */
    private $gridViewFactory;

    /**
     * @param ResourcesResolverInterface $decoratedResolver
     * @param GoogleProviderInterface $gridProvider
     * @param ResourceTreeGoogleViewFactoryInterface $gridViewFactory
     */
    public function __construct(
        ResourcesResolverInterface $decoratedResolver,
        GoogleProviderInterface $gridProvider,
        ResourceTreeGoogleViewFactoryInterface $gridViewFactory
    ) {
        $this->decoratedResolver = $decoratedResolver;
        $this->gridProvider = $gridProvider;
        $this->gridViewFactory = $gridViewFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getResources(RequestConfiguration $requestConfiguration, RepositoryInterface $repository)
    {
        if (!$requestConfiguration->hasGoogle()) {
            return $this->decoratedResolver->getResources($requestConfiguration, $repository);
        }

        $gridDefinition = $this->gridProvider->get($requestConfiguration->getGoogle());

        $request = $requestConfiguration->getRequest();
        $parameters = new Parameters($request->query->all());

        $gridView = $this->gridViewFactory->create($gridDefinition, $parameters, $requestConfiguration->getMetadata(), $requestConfiguration);

        if ($requestConfiguration->isHtmlRequest()) {
            return $gridView;
        }

        return $gridView->getData();
    }
}
