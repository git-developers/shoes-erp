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

namespace Bundle\ResourceBundle\DependencyInjection\Driver;

use Bundle\ResourceBundle\DependencyInjection\Driver\Doctrine\DoctrineODMDriver;
use Bundle\ResourceBundle\DependencyInjection\Driver\Doctrine\DoctrineORMDriver;
use Bundle\ResourceBundle\DependencyInjection\Driver\Doctrine\DoctrinePHPCRDriver;
use Bundle\ResourceBundle\DependencyInjection\Driver\Exception\UnknownDriverException;
use Bundle\ResourceBundle\ResourceBundle;
use Component\Resource\Metadata\MetadataInterface;

final class DriverProvider
{
    /**
     * @var DriverInterface[]
     */
    private static $drivers = [];

    /**
     * @param MetadataInterface $metadata
     *
     * @return DriverInterface
     *
     * @throws UnknownDriverException
     */
    public static function get(MetadataInterface $metadata)
    {
        $type = $metadata->getDriver();

        if (isset(self::$drivers[$type])) {
            return self::$drivers[$type];
        }

        switch ($type) {
            case ResourceBundle::DRIVER_DOCTRINE_ORM:
                return self::$drivers[$type] = new DoctrineORMDriver();
            case ResourceBundle::DRIVER_DOCTRINE_MONGODB_ODM:
                return self::$drivers[$type] = new DoctrineODMDriver();
            case ResourceBundle::DRIVER_DOCTRINE_PHPCR_ODM:
                return self::$drivers[$type] = new DoctrinePHPCRDriver();
        }

        throw new UnknownDriverException($type);
    }
}
