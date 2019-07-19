<?php

declare(strict_types=1);

namespace Component\Resource\Translation;

use Component\Resource\Model\TranslatableInterface;

interface TranslatableEntityLocaleAssignerInterface
{
    /**
     * @param TranslatableInterface $translatableEntity
     */
    public function assignLocale(TranslatableInterface $translatableEntity): void;
}
