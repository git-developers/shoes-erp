<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bundle\ResourceBundle\OneToMany\View;

use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Parameters;
use Component\Resource\Metadata\MetadataInterface;

interface ResourceOneToManyViewFactoryInterface
{
    /**
     * @param OneToMany $grid
     * @param Parameters $parameters
     * @param MetadataInterface $metadata
     * @param RequestConfiguration $requestConfiguration
     *
     * @return ResourceTreeOneToManyView
     */
    public function create(
        OneToMany $grid,
        Parameters $parameters,
        MetadataInterface $metadata,
        RequestConfiguration $requestConfiguration
    ): ResourceTreeOneToManyView;
}
