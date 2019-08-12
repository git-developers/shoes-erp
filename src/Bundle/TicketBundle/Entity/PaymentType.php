<?php
	
declare(strict_types=1);

namespace Bundle\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * PaymentType
 *
 */
class PaymentType
{
	
	const ROLE_PAYMENT_TYPE_VIEW = 'ROLE_PAYMENT_TYPE_VIEW';
	const ROLE_PAYMENT_TYPE_CREATE = 'ROLE_PAYMENT_TYPE_CREATE';
	const ROLE_PAYMENT_TYPE_EDIT = 'ROLE_PAYMENT_TYPE_EDIT';
	const ROLE_PAYMENT_TYPE_DELETE = 'ROLE_PAYMENT_TYPE_DELETE';
	
	
    /**
     * @var integer
     *
     * @JMSS\Groups({"crud"})
     */
    private $id;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({"crud"})
	 */
	private $code;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({"crud"})
	 */
	private $slug;

    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "crud",
     *     "sales"
     * })
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     */
	private $isActive = true;
	
	public function __toString() {
		return sprintf('(%s) %s', $this->id, $this->name);
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
     * Set name
     *
     * @param string $name
     *
     * @return PaymentType
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
	public function getCode() //: string
	{
		return $this->code;
	}
	
	/**
	 * @param string $code
	 */
	public function setCode(string $code)
	{
		$this->code = $code;
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PaymentType
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return PaymentType
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return PaymentType
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
}
