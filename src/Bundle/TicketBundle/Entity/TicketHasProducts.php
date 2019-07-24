<?php

namespace Bundle\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * TicketHasProducts
 *
 */
class TicketHasProducts
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
     * @var \Bundle\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Bundle\ProductBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({"crud"})
     */
    private $products;

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
     * @return TicketHasProducts
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
	 * @return \Bundle\ProductBundle\Entity\Product
	 */
	public function getProducts(): \Bundle\ProductBundle\Entity\Product
	{
		return $this->products;
	}
	
	/**
	 * @param \Bundle\ProductBundle\Entity\Product $products
	 */
	public function setProducts(\Bundle\ProductBundle\Entity\Product $products) //: void
	{
		$this->products = $products;
	}

    /**
     * Set ticket
     *
     * @param \Bundle\TicketBundle\Entity\Ticket $ticket
     *
     * @return TicketHasProducts
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
