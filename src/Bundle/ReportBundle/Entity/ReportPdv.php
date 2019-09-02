<?php
	
namespace Bundle\ReportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ReportPdv
 */
class ReportPdv
{
	
	const ROLE_REPORT_VIEW = 'ROLE_REPORT_VIEW';
	const ROLE_REPORT_CREATE = 'ROLE_REPORT_CREATE';
	const ROLE_REPORT_EDIT = 'ROLE_REPORT_EDIT';
	const ROLE_REPORT_DELETE = 'ROLE_REPORT_DELETE';
	
	/**
	 * @var integer
	 *
	 * @JMSS\Groups({"crud"})
	 */
	private $id;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({
	 *     "crud",
	 * })
	 */
	private $name;
	
	/**
	 * @var string
	 *
	 */
	private $slug;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({"crud"})
	 */
	private $pdvHash;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "sales",
	 *     "orders",
	 *     "pdv_product",
	 * })
	 */
	private $stockInitial;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "sales",
	 *     "orders",
	 *     "pdv_product",
	 * })
	 */
	private $stockOrders;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "sales",
	 *     "orders",
	 *     "pdv_product",
	 * })
	 */
	private $stockSales;
	
	/**
	 * @var \DateTime
	 *
	 * @JMSS\Groups({
	 *     "sales"
	 * })
	 * @JMSS\Type("DateTime<'Y-m-d H:i'>")
	 */
	private $createdAt;
	
	/**
	 * @var integer
	 */
	private $userCreate;
	
	/**
	 * @var \DateTime
	 */
	private $updatedAt;
	
	/**
	 * @var integer
	 */
	private $userUpdate;
	
	/**
	 * @var boolean
	 */
	private $isActive = '1';
	
    /**
     * @var \Bundle\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Bundle\ProductBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \Bundle\PointofsaleBundle\Entity\PointofsaleOpening
     *
     * @ORM\ManyToOne(targetEntity="Bundle\PointofsaleBundle\Entity\PointofsaleOpening")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pointofsale_opening_id", referencedColumnName="id")
     * })
     */
    private $pointofsaleOpening;



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
     * Set name
     *
     * @param string $name
     *
     * @return ReportPdv
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
	
	/**
	 * @return string
	 */
	public function getSlug() //: string
	{
		return $this->slug;
	}
	
	/**
	 * @param string $slug
	 */
	public function setSlug(string $slug)
	{
		$this->slug = $slug;
	}
	
	/**
	 * @return float
	 */
	public function getStockInitial(): float
	{
		return $this->stockInitial;
	}
	
	/**
	 * @param float $stockInitial
	 */
	public function setStockInitial( $stockInitial) //: void
	{
		$this->stockInitial = $stockInitial;
	}
	
	/**
	 * @return float
	 */
	public function getStockOrders()
	{
		return $this->stockOrders;
	}
	
	/**
	 * @param float $stockOrders
	 */
	public function setStockOrders(float $stockOrders)
	{
		$this->stockOrders = $stockOrders;
	}
	
	/**
	 * @return float
	 */
	public function getStockSales()
	{
		return $this->stockSales;
	}
	
	/**
	 * @param float $stockSales
	 */
	public function setStockSales(float $stockSales)
	{
		$this->stockSales = $stockSales;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt() //: \DateTime
	{
		return $this->createdAt;
	}
	
	/**
	 * @param \DateTime $createdAt
	 */
	public function setCreatedAt(\DateTime $createdAt)
	{
		$this->createdAt = $createdAt;
	}
	
	/**
	 * @return int
	 */
	public function getUserCreate(): int
	{
		return $this->userCreate;
	}
	
	/**
	 * @param int $userCreate
	 */
	public function setUserCreate(int $userCreate)
	{
		$this->userCreate = $userCreate;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getUpdatedAt(): \DateTime
	{
		return $this->updatedAt;
	}
	
	/**
	 * @param \DateTime $updatedAt
	 */
	public function setUpdatedAt(\DateTime $updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}
	
	/**
	 * @return int
	 */
	public function getUserUpdate(): int
	{
		return $this->userUpdate;
	}
	
	/**
	 * @param int $userUpdate
	 */
	public function setUserUpdate(int $userUpdate)
	{
		$this->userUpdate = $userUpdate;
	}
	
	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}
	
	/**
	 * @param bool $isActive
	 */
	public function setIsActive(bool $isActive)
	{
		$this->isActive = $isActive;
	}
	
	/**
	 * @return \Bundle\PointofsaleBundle\Entity\PointofsaleOpening
	 */
	public function getPointofsaleOpening(): \Bundle\PointofsaleBundle\Entity\PointofsaleOpening
	{
		return $this->pointofsaleOpening;
	}
	
	/**
	 * @param \Bundle\PointofsaleBundle\Entity\PointofsaleOpening $pointofsaleOpening
	 */
	public function setPointofsaleOpening(\Bundle\PointofsaleBundle\Entity\PointofsaleOpening $pointofsaleOpening)
	{
		$this->pointofsaleOpening = $pointofsaleOpening;
	}
	
	/**
	 * Set product
	 *
	 * @param \Bundle\ProductBundle\Entity\Product $product
	 *
	 * @return Report
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
	
	/**
	 * @return string
	 */
	public function getPdvHash() //: string
	{
		return $this->pdvHash;
	}
	
	/**
	 * @param string $pdvHash
	 */
	public function setPdvHash(string $pdvHash)
	{
		$this->pdvHash = $pdvHash;
	}
	
}
