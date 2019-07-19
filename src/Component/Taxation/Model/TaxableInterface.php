<?php

declare(strict_types=1);

namespace Component\Taxation\Model;

interface TaxableInterface
{
    /**
     * @return TaxCategoryInterface|null
     */
    public function getTaxCategory(): ?TaxCategoryInterface;
}
