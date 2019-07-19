<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Grid\Controller;

use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Bundle\ResourceBundle\Controller\ResourcesResolverInterface;
use Bundle\ResourceBundle\Grid\View\ResourceGridViewFactoryInterface;
use Component\Grid\Parameters;
use Component\Grid\Provider\GridProviderInterface;
use Component\Resource\Repository\RepositoryInterface;

final class ResourcesResolver implements ResourcesResolverInterface
{
    /**
     * @var ResourcesResolverInterface
     */
    private $decoratedResolver;

    /**
     * @var GridProviderInterface
     */
    private $gridProvider;

    /**
     * @var ResourceGridViewFactoryInterface
     */
    private $gridViewFactory;

    /**
     * @param ResourcesResolverInterface $decoratedResolver
     * @param GridProviderInterface $gridProvider
     * @param ResourceGridViewFactoryInterface $gridViewFactory
     */
    public function __construct(
        ResourcesResolverInterface $decoratedResolver,
        GridProviderInterface $gridProvider,
        ResourceGridViewFactoryInterface $gridViewFactory
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
        if (!$requestConfiguration->hasGrid()) {
            return $this->decoratedResolver->getResources($requestConfiguration, $repository);
        }

        $gridDefinition = $this->gridProvider->get($requestConfiguration->getGrid());

        $request = $requestConfiguration->getRequest();
        $parameters = new Parameters($request->query->all());

        $gridView = $this->gridViewFactory->create($gridDefinition, $parameters, $requestConfiguration->getMetadata(), $requestConfiguration);

        if ($requestConfiguration->isHtmlRequest()) {
            return $gridView;
        }

        return $gridView->getData();
    }
}
