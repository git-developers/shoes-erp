<?php

declare(strict_types=1);

namespace Component\Resource\Model;

interface ToggleableInterface
{
    /**
     * Missing scalar typehint because it conflicts with AdvancedUserInterface.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * @param bool $enabled
     */
    public function setEnabled(?bool $enabled): void;

    public function enable(): void;

    public function disable(): void;
}
