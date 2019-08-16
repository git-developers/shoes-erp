<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Entity;

/**
 * PointOfSale.
 */
class PointOfSale
{

    /**
     * @var int
     */
    private $code;

    /**
     * Set code
     *
     * @param int $code
     *
     * @return PointOfSale
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

}

