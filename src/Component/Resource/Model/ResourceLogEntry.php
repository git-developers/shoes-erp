<?php

declare(strict_types=1);

namespace Component\Resource\Model;

use Gedmo\Loggable\Entity\MappedSuperclass\AbstractLogEntry;

abstract class ResourceLogEntry extends AbstractLogEntry implements ResourceInterface
{
}
