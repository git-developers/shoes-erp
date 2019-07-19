<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Entity;

/**
 * Employee.
 */
class Employee
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
     * @return Employee
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

