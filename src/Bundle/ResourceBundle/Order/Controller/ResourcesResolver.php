<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Order\Controller;

use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Bundle\ResourceBundle\Controller\ResourcesResolverInterface;
use Bundle\ResourceBundle\OneToMany\View\ResourceTreeOneToManyViewFactoryInterface;
use Component\Order\Parameters;
use Component\Order\Provider\OrderProviderInterface;
use Component\Resource\Repository\RepositoryInterface;

final class ResourcesResolver implements ResourcesResolverInterface
{
    /**
     * @var ResourcesResolverInterface
     */
    private $decoratedResolver;

    /**
     * @var OrderProviderInterface
     */
    private $gridProvider;

    /**
     * @var ResourceTreeOrderViewFactoryInterface
     */
    private $gridViewFactory;

    /**
     * @param ResourcesResolverInterface $decoratedResolver
     * @param OrderProviderInterface $gridProvider
     * @param ResourceTreeOrderViewFactoryInterface $gridViewFactory
     */
    public function __construct(
        ResourcesResolverInterface $decoratedResolver,
        OrderProviderInterface $gridProvider,
        ResourceTreeOrderViewFactoryInterface $gridViewFactory
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
        if (!$requestConfiguration->hasOrder()) {
            return $this->decoratedResolver->getResources($requestConfiguration, $repository);
        }

        $gridDefinition = $this->gridProvider->get($requestConfiguration->getOrder());

        $request = $requestConfiguration->getRequest();
        $parameters = new Parameters($request->query->all());

        $gridView = $this->gridViewFactory->create($gridDefinition, $parameters, $requestConfiguration->getMetadata(), $requestConfiguration);

        if ($requestConfiguration->isHtmlRequest()) {
            return $gridView;
        }

        return $gridView->getData();
    }
}
