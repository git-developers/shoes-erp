<?php

declare(strict_types=1);

namespace Bundle\UiBundle\Twig;

class PercentageExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters(): array
    {
        return [
            new \Twig_Filter('sylius_percentage', [$this, 'getPercentage']),
        ];
    }

    /**
     * @param float $number
     *
     * @return string
     */
    public function getPercentage(float $number): string
    {
        $percentage = $number * 100;

        return $percentage . ' %';
    }
}
