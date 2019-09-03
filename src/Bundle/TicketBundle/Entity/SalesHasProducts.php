<?php

namespace Bundle\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * SalesHasProducts
 *
 */
class SalesHasProducts
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
     * @var float
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
    private $product;

    /**
     * @var \Bundle\TicketBundle\Entity\Sales
     *
     * @ORM\ManyToOne(targetEntity="Bundle\TicketBundle\Entity\Sales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sales_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({"crud"})
     */
    private $sales;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "crud"
	 * })
	 */
	private $unitPrice;

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
	 * @return float
	 */
	public function getQuantity() //: float
	{
		return $this->quantity;
	}
	
	/**
	 * @param float $quantity
	 */
	public function setQuantity(float $quantity)
	{
		$this->quantity = $quantity;
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
	public function getProduct(): \Bundle\ProductBundle\Entity\Product
	{
		return $this->product;
	}
	
	/**
	 * @param \Bundle\ProductBundle\Entity\Product $product
	 */
	public function setProduct(\Bundle\ProductBundle\Entity\Product $product) //: void
	{
		$this->product = $product;
	}
	
	/**
	 * @return Sales
	 *
	 * @return \Bundle\TicketBundle\Entity\Sales
	 */
	public function getSales() //: Sales
	{
		return $this->sales;
	}
	
	/**
	 * @param Sales $sales
	 *
	 * @param \Bundle\TicketBundle\Entity\Sales $sales
	 */
	public function setSales(Sales $sales)
	{
		$this->sales = $sales;
	}
	
}
