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
use Symfony\Component\Form\FormInterface;

interface ResourceFormFactoryInterface
{
    /**
     * @param RequestConfiguration $requestConfiguration
     * @param ResourceInterface $resource
     *
     * @return FormInterface
     */
    public function create(RequestConfiguration $requestConfiguration, ResourceInterface $resource): FormInterface;
}
