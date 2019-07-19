<?php

namespace Bundle\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * TicketHasServices
 *
 */
class TicketHasServices
{
    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     *     "ticket"
     * })
     */
    private $id;

    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     *     "ticket"
     * })
     */
    private $quantity;

    /**
     * @var \Bundle\ServicesBundle\Entity\Services
     *
     * @ORM\ManyToOne(targetEntity="Bundle\ServicesBundle\Entity\Services")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({"crud"})
     */
    private $services;

    /**
     * @var \Bundle\TicketBundle\Entity\Ticket
     *
     * @ORM\ManyToOne(targetEntity="Bundle\TicketBundle\Entity\Ticket")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ticket_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({"crud"})
     */
    private $ticket;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "crud"
	 * })
	 */
	private $unitPrice;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "crud"
	 * })
	 */
	private $subTotal;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return TicketHasServices
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
	
	/**
	 * @return float
	 */
	public function getSubTotal(): float
	{
		return $this->subTotal;
	}
	
	/**
	 * @param float $subTotal
	 */
	public function setSubTotal(float $subTotal) //: void
	{
		$this->subTotal = $subTotal;
	}
	
	/**
	 * @return float
	 */
	public function getUnitPrice(): float
	{
		return $this->unitPrice;
	}
	
	/**
	 * @param float $unitPrice
	 */
	public function setUnitPrice(float $unitPrice) //: void
	{
		$this->unitPrice = $unitPrice;
	}

    /**
     * Set services
     *
     * @param \Bundle\ServicesBundle\Entity\Services $services
     *
     * @return TicketHasServices
     */
    public function setServices(\Bundle\ServicesBundle\Entity\Services $services = null)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * Get services
     *
     * @return \Bundle\ServicesBundle\Entity\Services
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set ticket
     *
     * @param \Bundle\TicketBundle\Entity\Ticket $ticket
     *
     * @return TicketHasServices
     */
    public function setTicket(\Bundle\TicketBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \Bundle\TicketBundle\Entity\Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
