<?php
	
declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * PointofsaleHasProduct
 *
 */
class PointofsaleHasProduct
{
    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     * })
     */
    private $id;

    /**
     * @var float
     *
     * @JMSS\Groups({
     *     "sales",
     *     "orders",
     *     "pdv_product",
     * })
     */
    private $stock;

    /**
     * @var \Bundle\PointofsaleBundle\Entity\Pointofsale
     *
     * @ORM\ManyToOne(targetEntity="Bundle\PointofsaleBundle\Entity\Pointofsale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id")
     * })
     *
     */
    private $pointOfSale;

    /**
     * @var \Bundle\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Bundle\ProductBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({
     *     "pdv_product",
     *     "sales",
     *     "orders",
     * })
     */
    private $product;
    

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
	public function getStock() //: float
	{
		return $this->stock;
	}
	
	/**
	 * @param float $stock
	 */
	public function setStock(float $stock) //: void
	{
		$this->stock = $stock;
	}
	

	
    /**
     * Set pointOfSale
     *
     * @param \Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale
     *
     * @return PointofsaleHasProduct
     */
    public function setPointOfSale(\Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale = null)
    {
        $this->pointOfSale = $pointOfSale;

        return $this;
    }

    /**
     * Get pointOfSale
     *
     * @return \Bundle\PointofsaleBundle\Entity\Pointofsale
     */
    public function getPointOfSale()
    {
        return $this->pointOfSale;
    }

    /**
     * Set product
     *
     * @param \Bundle\ProductBundle\Entity\Product $product
     *
     * @return PointofsaleHasProduct
     */
    public function setProduct(\Bundle\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Bundle\ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
