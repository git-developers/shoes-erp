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

namespace Bundle\ResourceBundle\Controller;

use Component\Resource\Model\ResourceInterface;
use Component\Resource\Repository\RepositoryInterface;

interface ResourceDeleteHandlerInterface
{
    /**
     * @param ResourceInterface $resource
     * @param RepositoryInterface $repository
     */
    public function handle(ResourceInterface $resource, RepositoryInterface $repository): void;
}
