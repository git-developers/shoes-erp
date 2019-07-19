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

namespace Component\Tree\Data;

use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;

interface DataSourceProviderInterface
{
    /**
     * @param Tree $grid
     * @param Parameters $parameters
     *
     * @return DataSourceInterface
     */
    public function getDataSource(Tree $grid, Parameters $parameters): DataSourceInterface;
}
