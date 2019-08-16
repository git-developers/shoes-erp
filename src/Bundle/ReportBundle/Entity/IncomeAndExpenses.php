<?php
	
namespace Bundle\ReportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * IncomeAndExpenses
 */
class IncomeAndExpenses
{
	
	const CONTENTS_IN = "IN";
	const CONTENTS_OUT = "OUT";
	
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
	private $contents;
	
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
	private $amount = 0;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({"crud"})
	 */
	private $pdvHash;
	
	/**
	 * @var \DateTime
	 *
	 * @JMSS\Groups({"crud"})
	 * @JMSS\Type("DateTime<'Y-m-d H:i'>")
	 */
	private $openingDate;
	
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
     * @return IncomeAndExpenses
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
	 * @return int
	 */
	public function getStockInitial(): int
	{
		return $this->stockInitial;
	}
	
	/**
	 * @param int $stockInitial
	 */
	public function setStockInitial(int $stockInitial)
	{
		$this->stockInitial = $stockInitial;
	}
	
	/**
	 * @return int
	 */
	public function getStockOrders(): int
	{
		return $this->stockOrders;
	}
	
	/**
	 * @param int $stockOrders
	 */
	public function setStockOrders(int $stockOrders)
	{
		$this->stockOrders = $stockOrders;
	}
	
	/**
	 * @return int
	 */
	public function getStockSales() //: int
	{
		return $this->stockSales;
	}
	
	/**
	 * @param int $stockSales
	 */
	public function setStockSales(int $stockSales)
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
	
	/**
	 * @return string
	 */
	public function getContents(): string
	{
		return $this->contents;
	}
	
	/**
	 * @param string $contents
	 */
	public function setContents(string $contents)
	{
		$this->contents = $contents;
	}
	
	/**
	 * @return float
	 */
	public function getAmount(): float
	{
		return $this->amount;
	}
	
	/**
	 * @param float $amount
	 */
	public function setAmount(float $amount)
	{
		$this->amount = $amount;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getOpeningDate() //: \DateTime
	{
		return $this->openingDate;
	}
	
	/**
	 * @param \DateTime $openingDate
	 */
	public function setOpeningDate(\DateTime $openingDate)
	{
		$this->openingDate = $openingDate;
	}
	
	
	
}
