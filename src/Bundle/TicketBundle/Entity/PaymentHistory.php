<?php
	
declare(strict_types=1);

namespace Bundle\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * PaymentHistory
 *
 */
class PaymentHistory
{
    /**
     * @var integer
     *
     * @JMSS\Groups({"sales"})
     */
    private $id;
    /**
     * @var integer
     *
     * @JMSS\Groups({"sales"})
     */
    private $salesId;
    
    /**
     * @var string
     *
     * @JMSS\Groups({"sales"})
     */
    private $name;
	
	/**
	 * @var string
	 */
	private $slug;

    /**
     * @var \Bundle\TicketBundle\Entity\Sales
     *
     * @ORM\ManyToOne(targetEntity="Bundle\TicketBundle\Entity\Sales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sales_id", referencedColumnName="id")
     * })
     */
    private $sales;
	
	/**
	 * @var \Bundle\TicketBundle\Entity\PaymentType
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\TicketBundle\Entity\PaymentType")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="payment_type_id", referencedColumnName="id")
	 * })
	 *
	 * @JMSS\Groups({"sales"})
	 */
	private $paymentType;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "crud"
	 * })
	 */
	private $subTotal = 0;
	
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
	 *     "sales"
	 * })
	 */
	private $payment;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "sales"
	 * })
	 */
	private $changeBack;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "sales"
	 * })
	 */
	private $paymentCollected = 0;
	
	/**
	 * @var float
	 *
	 * @JMSS\Groups({
	 *     "crud"
	 * })
	 */
	private $total = 0;
	
	/**
	 * @var \DateTime
	 *
	 * @JMSS\Groups({"sales"})
	 * @JMSS\Type("DateTime<'Y-m-d'>")
	 */
	private $receivedDate;
	
	/**
	 * @var \DateTime
	 *
	 * @JMSS\Groups({"sales"})
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
     * @return PaymentHistory
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
	 * Get sales
	 *
	 * @return \Bundle\TicketBundle\Entity\Sales
	 */
	public function getSales() //: \Bundle\TicketBundle\Entity\Sales
	{
		return $this->sales;
	}
	
	/**
	 * Set sales
	 *
	 * @param \Bundle\TicketBundle\Entity\Sales $sales
	 *
	 * @return PaymentHistory
	 */
	public function setSales(\Bundle\TicketBundle\Entity\Sales $sales)
	{
		$this->sales = $sales;
	}
	
	/**
	 * @return PaymentType
	 *
	 * @return \Bundle\TicketBundle\Entity\PaymentType
	 */
	public function getPaymentType() //: PaymentType
	{
		return $this->paymentType;
	}
	
	/**
	 * @param PaymentType $paymentType
	 *
	 * @param \Bundle\TicketBundle\Entity\PaymentType $paymentType
	 *
	 * @return Sales
	 */
	//public function setPaymentType(\Bundle\TicketBundle\Entity\PaymentType $paymentType)
	public function setPaymentType(\Bundle\TicketBundle\Entity\PaymentType $paymentType)
	{
		$this->paymentType = $paymentType;
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
	 * @return \DateTime
	 */
	public function getReceivedDate() //: \DateTime
	{
		return $this->receivedDate;
	}
	
	/**
	 * @param \DateTime $receivedDate
	 */
	public function setReceivedDate(\DateTime $receivedDate)
	{
		$this->receivedDate = $receivedDate;
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
	public function getUserCreate() //: int
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
	public function getUpdatedAt() //: \DateTime
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
	public function getUserUpdate() //: int
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
	public function isActive() //: bool
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
		$this->payment = empty($payment) ? 0 : $payment;
	}
	
	/**
	 * @return float
	 */
	public function getChangeBack() //: float
	{
		return $this->changeBack;
	}
	
	/**
	 * @param float $changeBack
	 */
	public function setChangeBack($changeBack)
	{
		$this->changeBack = empty($changeBack) ? 0 : $changeBack;
	}
	
	/**
	 * @return int
	 */
	public function getSalesId() //: int
	{
		return $this->salesId;
	}
	
	/**
	 * @param int $salesId
	 */
	public function setSalesId(int $salesId)
	{
		$this->salesId = $salesId;
	}
	
	/**
	 * @return float
	 */
	public function getPaymentCollected() //: float
	{
		return $this->paymentCollected;
	}
	
	/**
	 * @param float $paymentCollected
	 */
	public function setPaymentCollected(float $paymentCollected)
	{
		$this->paymentCollected = $paymentCollected;
	}
	

	
	
}
