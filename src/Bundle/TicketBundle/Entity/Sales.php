<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Sales
 */
class Sales
{
	
	const ROLE_SALES_VIEW = 'ROLE_SALES_VIEW';
	const ROLE_SALES_CREATE = 'ROLE_SALES_CREATE';
	const ROLE_SALES_EDIT = 'ROLE_SALES_EDIT';
	const ROLE_SALES_DELETE = 'ROLE_SALES_DELETE';
	
	const STATUS_OPEN = 1;
	const STATUS_IN_PROGRESS = 2;
	const STATUS_CANCELED = 4;
	const STATUS_VOIDED = 5;
	const STATUS_READY_FOR_SALE = 6;
	
	const INCREMENT = 'INCREMENT';
	const DECREMENT = 'DECREMENT';
	
    /**
     * @var integer
     *
     * @JMSS\Groups({"sales"})
     */
    private $id;

    /**
     * @var string
     *
     * @JMSS\Groups({"sales"})
     */
    private $code;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "pdv_product",
	 *     "sales"
	 * })
	 *
	 */
	private $discount = 0;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "pdv_product",
	 *     "sales"
	 * })
	 *
	 */
	private $payment = 0;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "sales"
	 * })
	 */
	private $total = 0;
    
    /**
     * @var string
     *
     * @JMSS\Groups({"sales"})
     */
    private $name;

    /**
     * @var integer
     *
     * @JMSS\Groups({"sales"})
     */
    private $status;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"sales"})
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     */
    private $createdAt;
	
	/**
	 * @var \DateTime
	 *
	 * @JMSS\Groups({"sales"})
	 * @JMSS\Type("DateTime<'Y-m-d'>")
	 */
	private $deliveryDate;

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
	 * @var \Bundle\UserBundle\Entity\User
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\UserBundle\Entity\User")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="client_id", referencedColumnName="id")
	 * })
	 *
	 * @JMSS\Groups({"sales"})
	 */
	private $client;
	
	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\ManyToMany(targetEntity="Bundle\UserBundle\Entity\User", inversedBy="sales")
	 * @ORM\JoinTable(name="sales_has_employee",
	 *   joinColumns={
	 *     @ORM\JoinColumn(name="sales_id", referencedColumnName="id")
	 *   },
	 *   inverseJoinColumns={
	 *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 *   }
	 * )
	 *
	 * @JMSS\Groups({"sales"})
	 */
	private $employee;
	
	/**
	 * @var \Bundle\PointofsaleBundle\Entity\Pointofsale
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\PointofsaleBundle\Entity\Pointofsale")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id")
	 * })
	 *
	 * @JMSS\Groups({"sales"})
	 */
	private $pointOfSale;
	
	/**
	 * @var \Bundle\TicketBundle\Entity\PaymentType
	 *
	 * @JMSS\Groups({"sales"})
	 */
	private $paymentType;
	
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->employee = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Sales
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
     * Set name
     *
     * @param string $name
     *
     * @return Sales
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Sales
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
     * @return Sales
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
	 * @return \DateTime
	 */
	public function getDeliveryDate() //: \DateTime
	{
		$date = $this->deliveryDate;
		
		if (!is_null($date)) {
			return $date->format('Y-m-d');
		}
		
		return null;
	}
	
	/**
	 * @return float
	 */
	public function getTotal() //: float
	{
		return $this->total;
	}
	
	/**
	 * @param float $total
	 */
	public function setTotal($total)
	{
		$this->total = empty($total) ? 0 : $total;
	}
	
	/**
	 * @param \DateTime $deliveryDate
	 */
	public function setDeliveryDate($deliveryDate)
	{
		$this->deliveryDate = $deliveryDate;
	}

    /**
     * Set userCreate
     *
     * @param integer $userCreate
     *
     * @return Sales
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
     * @return Sales
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
     * @return Sales
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
     * @return Sales
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
	 * Set client
	 *
	 * @param \Bundle\UserBundle\Entity\User $client
	 *
	 * @return Sales
	 */
	public function setClient(\Bundle\UserBundle\Entity\User $client = null)
	{
		$this->client = $client;
		
		return $this;
	}
	
	/**
	 * Get client
	 *
	 * @return \Bundle\UserBundle\Entity\User
	 */
	public function getClient()
	{
		return $this->client;
	}
	
	/**
	 * Add employee
	 *
	 * @param \Bundle\UserBundle\Entity\User $employee
	 *
	 * @return Sales
	 */
	public function addEmployee(\Bundle\UserBundle\Entity\User $employee)
	{
		$this->employee[] = $employee;
		
		return $this;
	}
	
	/**
	 * Remove employee
	 *
	 * @param \Bundle\UserBundle\Entity\User $user
	 */
	public function removeEmployee(\Bundle\UserBundle\Entity\User $employee)
	{
		$this->employee->removeElement($employee);
	}
	
	/**
	 * Get employee
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getEmployee()
	{
		return $this->employee;
	}
	
	/**
	 * Set pointOfSale
	 *
	 * @param \Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale
	 *
	 * @return Sales
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
	 * @return int
	 */
	public function getStatus() //: int
	{
		return $this->status;
	}
	
	/**
	 * @param int $status
	 */
	public function setStatus(int $status)
	{
		$this->status = $status;
	}
	
	/**
	 * @return float
	 */
	public function getDiscount() //: float
	{
		return $this->discount;
	}
	
	/**
	 * @param float $discount
	 */
	public function setDiscount($discount)
	{
//		$this->discount = $discount;
		$this->discount = empty($discount) ? 0 : $discount;
	}
	
	/**
	 * @return float
	 */
	public function getPayment() //: float
	{
		return $this->payment;
	}
	
	/**
	 * @param float $payment
	 */
	public function setPayment($payment)
	{
//		$this->payment = $payment;
		$this->payment = empty($payment) ? 0 : $payment;
	}
	
	/**
	 * @return PaymentType
	 */
	public function getPaymentType() //: PaymentType
	{
		return $this->paymentType;
	}
	
	/**
	 * @param PaymentType $paymentType
	 */
	public function setPaymentType(PaymentType $paymentType)
	{
		$this->paymentType = $paymentType;
	}
	
	
}

