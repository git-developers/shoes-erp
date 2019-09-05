<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Product
 *
 * @UniqueEntity(
 *     fields={"barcode"},
 *     message="El barcode fue registrado anteriormente"
 * )
 */
class Product
{
	
	const ROLE_PRODUCT_VIEW = 'ROLE_PRODUCT_VIEW';
	const ROLE_PRODUCT_CREATE = 'ROLE_PRODUCT_CREATE';
	const ROLE_PRODUCT_EDIT = 'ROLE_PRODUCT_EDIT';
	const ROLE_PRODUCT_DELETE = 'ROLE_PRODUCT_DELETE';
	const BARCODE = 99887766;
	
    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "pdv_product",
     *     "sales",
     *     "orders"
     * })
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 7,
     *      minMessage = "Minimo caracteres {{ limit }} para el codigo",
     *      maxMessage = "Maximo caracteres {{ limit }} para el codigo"
     * )
     *
     * @JMSS\Groups({
     *     "pdv_product",
     * })
     */
    private $code;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "pdv_product",
	 *     "sales",
	 *     "orders"
	 * })
	 *
	 */
	private $price = 0;
	//* @Assert\Type(type="float", message="Validar precio")
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "pdv_product",
	 *     "sales",
	 *     "orders",
	 * })
	 *
	 */
	private $cost = 0;
    
    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "pdv_product",
     *     "sales",
     *     "orders"
     * })
     */
    private $name;
    
    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "pdv_product",
     *     "sales"
     * })
     */
    private $reference;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "sales",
     *     "orders",
     *     "pdv_product"
     * })
     */
    private $size;

    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "sales",
     *     "orders"
     * })
     */
    private $sizeRange;

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
     * @var boolean
     *
     * @JMSS\Groups({
     *     "sales"
     * })
     */
    private $outOfStock;

    /**
     * @var \Bundle\CategoryBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Bundle\CategoryBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({
     *     "sales",
     *     "orders"
     * })
     */
    private $category;
	
	/**
	 * @var \Bundle\ProductBundle\Entity\Unit
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\ProductBundle\Entity\Unit")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
	 * })
	 *
	 * @JMSS\Groups({
	 *     "sales"
	 * })
	 */
	private $unit;
	
	/**
	 * @var \Bundle\ProductBundle\Entity\Color
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\ProductBundle\Entity\Color")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="color_id", referencedColumnName="id")
	 * })
	 *
	 * @JMSS\Groups({
	 *     "sales",
	 *     "orders",
	 *     "pdv_product",
	 * })
	 *
	 * @Assert\NotBlank(message="Agregue un color")
	 */
	private $color;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "sales",
	 *     "orders"
	 * })
	 */
	private $quantity;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({
	 *     "pdv_product",
	 *     "sales"
	 * })
	 */
	private $barcode;
	
	/**
	 * @var array
	 *
	 * @JMSS\Groups({
	 *     "pdv_product",
	 *     "sales",
	 *     "orders"
	 * })
	 */
	private $files;
	
	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * * @Assert\NotBlank(message="Agregue puntos de venta")
	 */
	private $pdvHasproduct;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->pdvHasproduct = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
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
     * Set code
     *
     * @param string $code
     *
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
	
	/**
	 * @return string
	 */
	public function getSize() //: string
	{
		return $this->size;
	}
	
	/**
	 * @param string $size
	 */
	public function setSize(string $size)
	{
		$this->size = $size;
	}
	
	/**
	 * @return string
	 */
	public function getSizeRange() //: string
	{
		return $this->sizeRange;
	}
	
	/**
	 * @param string $sizeRange
	 */
	public function setSizeRange(string $sizeRange)
	{
		$this->sizeRange = $sizeRange;
	}
	
	/**
	 * @return float
	 */
	public function getPrice() //: float
	{
		return $this->price;
	}
	
	/**
	 * @param float $price
	 */
	public function setPrice($price)
	{
		$this->price = empty($price) ? 0 : $price;
	}
	
	/**
	 * @return float
	 */
	public function getCost() //: float
	{
		return $this->cost;
	}
	
	/**
	 * @param float $cost
	 */
	public function setCost($cost)
	{
		$this->cost = empty($cost) ? 0 : $cost;
	}
	
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
	public function getReference() //: string
	{
		return $this->reference;
	}
	
	/**
	 * @param string $reference
	 */
	public function setReference(string $reference)
	{
		$this->reference = $reference;
	}
	
    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set userCreate
     *
     * @param integer $userCreate
     *
     * @return Product
     */
    public function setUserCreate($userCreate)
    {
        $this->userCreate = $userCreate;

        return $this;
    }

    /**
     * Get userCreate
     *
     * @return integer
     */
    public function getUserCreate()
    {
        return $this->userCreate;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set userUpdate
     *
     * @param integer $userUpdate
     *
     * @return Product
     */
    public function setUserUpdate($userUpdate)
    {
        $this->userUpdate = $userUpdate;

        return $this;
    }

    /**
     * Get userUpdate
     *
     * @return integer
     */
    public function getUserUpdate()
    {
        return $this->userUpdate;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Product
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set category
     *
     * @param \Bundle\CategoryBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\Bundle\CategoryBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Bundle\CategoryBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
	
	/**
	 * Set unit
	 *
	 * @param \Bundle\ProductBundle\Entity\Unit $unit
	 *
	 * @return Product
	 */
	public function setUnit(\Bundle\ProductBundle\Entity\Unit $unit = null)
	{
		$this->unit = $unit;
		
		return $this;
	}
	
	/**
	 * Get unit
	 *
	 * @return \Bundle\ProductBundle\Entity\Unit
	 */
	public function getUnit()
	{
		return $this->unit;
	}
	
	/**
	 * @return float
	 */
	public function getQuantity()
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
	 * @return array
	 */
	public function getFiles(): array
	{
		return $this->files;
	}
	
	/**
	 * @param array $files
	 */
	public function setFiles(array $files) //: void
	{
		$this->files = $files;
		
		return $this;
	}
	
	/**
	 * @return Color
	 */
	public function getColor() //: Color
	{
		return $this->color;
	}
	
	/**
	 * @return string
	 */
	public function getBarcode() //: string
	{
		return $this->barcode;
	}
	
	/**
	 * @param string $barcode
	 */
	public function setBarcode(string $barcode)
	{
		$this->barcode = $barcode;
	}
	
	/**
	 * @param Color $color
	 */
	public function setColor(\Bundle\ProductBundle\Entity\Color $color) //: void
	{
		$this->color = $color;
		
		return $this;
	}
	
	/**
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPdvHasproduct() //: \Doctrine\Common\Collections\Collection
	{
		return $this->pdvHasproduct;
	}
	
	/**
	 * @param \Doctrine\Common\Collections\Collection $pdvHasproduct
	 */
	public function setPdvHasproduct(\Doctrine\Common\Collections\Collection $pdvHasproduct)
	{
		$this->pdvHasproduct = $pdvHasproduct;
	}
	
	/**
	 * @return bool
	 */
	public function isOutOfStock() //: bool
	{
		return $this->outOfStock;
	}
	
	/**
	 * @param bool $outOfStock
	 */
	public function setOutOfStock(bool $outOfStock)
	{
		$this->outOfStock = $outOfStock;
	}
	
	
}

