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

namespace spec\Component\Resource\Fixtures;

use Component\Resource\Model\ResourceInterface;

interface SampleBookResourceInterface extends ResourceInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getRating();

    /**
     * @return string
     */
    public function getTitle();
}
