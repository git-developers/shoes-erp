<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Context;

use Bundle\ThemeBundle\Model\ThemeInterface;

final class EmptyThemeContext implements ThemeContextInterface
{
    /**
     * {@inheritdoc}
     */
    public function getTheme(): ?ThemeInterface
    {
        return null;
    }
}
