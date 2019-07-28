<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Ticket
 */
class Ticket
{
	
	const ROLE_TICKET_VIEW = 'ROLE_TICKET_VIEW';
	const ROLE_TICKET_CREATE = 'ROLE_TICKET_CREATE';
	const ROLE_TICKET_EDIT = 'ROLE_TICKET_EDIT';
	const ROLE_TICKET_DELETE = 'ROLE_TICKET_DELETE';
	
	const INTERNO = 'INTERNO';
	const EXTERNO = 'EXTERNO';
	
	
    /**
     * @var integer
     *
     * @JMSS\Groups({"ticket"})
     */
    private $id;

    /**
     * @var string
     */
    private $code;
	
	/**
	 * @var \DateTime
	 *
	 * @JMSS\Groups({"ticket"})
	 * @JMSS\Type("DateTime<'Y-m-d H:i'>")
	 */
	private $dateTicket;

    /**
     * @var string
     *
     * @JMSS\Groups({"ticket"})
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     *
     * @JMSS\Groups({"ticket"})
     */
    private $ticketType;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"ticket"})
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
	 * @var \Bundle\TicketBundle\Entity\PaymentType
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\TicketBundle\Entity\PaymentType")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="payment_type_id", referencedColumnName="id")
	 * })
	 *
	 * @JMSS\Groups({"ticket"})
	 */
	private $paymentType;
	
	/**
	 * @var \Bundle\UserBundle\Entity\User
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\UserBundle\Entity\User")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="client_id", referencedColumnName="id")
	 * })
	 *
	 * @JMSS\Groups({"ticket"})
	 */
	private $client;
	
	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\ManyToMany(targetEntity="Bundle\UserBundle\Entity\User", inversedBy="ticket")
	 * @ORM\JoinTable(name="ticket_has_employee",
	 *   joinColumns={
	 *     @ORM\JoinColumn(name="ticket_id", referencedColumnName="id")
	 *   },
	 *   inverseJoinColumns={
	 *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 *   }
	 * )
	 *
	 * @JMSS\Groups({"ticket"})
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
	 * @JMSS\Groups({"ticket"})
	 */
	private $pointOfSale;
	
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
     * @return Ticket
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
     * @return Ticket
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
	public function getTicketType() //: string
	{
		return $this->ticketType;
	}
	
	/**
	 * @param string $ticketType
	 */
	public function setTicketType(string $ticketType)
	{
		$this->ticketType = $ticketType;
	}

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Ticket
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
     * @return Ticket
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
	public function getDateTicket() //: \DateTime
	{
		$date = $this->dateTicket;
		return $date->format('Y-m-d');
	}
	
	/**
	 * @param \DateTime $dateTicket
	 */
	public function setDateTicket(\DateTime $dateTicket) //: void
	{
		$this->dateTicket = $dateTicket;
	}
	

    /**
     * Set userCreate
     *
     * @param integer $userCreate
     *
     * @return Ticket
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
     * @return Ticket
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
     * @return Ticket
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
     * @return Ticket
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
	 * @return Ticket
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
	 * @return Ticket
	 */
	//public function setPaymentType(\Bundle\TicketBundle\Entity\PaymentType $paymentType)
	public function setPaymentType(\Bundle\TicketBundle\Entity\PaymentType $paymentType)
	{
		$this->paymentType = $paymentType;
	}
	
	/**
	 * Add employee
	 *
	 * @param \Bundle\UserBundle\Entity\User $employee
	 *
	 * @return Ticket
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
	 * @return Ticket
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
}

