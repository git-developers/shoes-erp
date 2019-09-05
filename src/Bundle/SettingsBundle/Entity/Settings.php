<?php

declare(strict_types=1);

namespace Bundle\SettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Settings
 */
class Settings
{
	
	const SYSTEM_EMAIL = "SYSTEM_EMAIL";
	const SALES_QUANTITY = "SALES_QUANTITY";
	const SALES_QUANTITY_PRICE_X = "SALES_QUANTITY_PRICE_X";
	const PRINTER_FILENAME = "PRINTER_FILENAME";

    /**
     * @var integer
     *
     * @JMSS\Groups({"crud"})
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud"})
     */
    private $name;

    /**
     * @var string
     */
    private $slug;
	
	/**
	 * @var string
	 *
	 */
	private $className;
	
	/**
	 * @var string
	 *
	 */
	private $classValue;
	
	/**
	 * @var string
	 *
	 */
	private $systemEmail;
	
	/**
	 * @var string
	 *
	 */
	private $printerFilename;
	
	/**
	 * @var float
	 *
	 */
	private $salesQuantity;
	
	/**
	 * @var integer
	 *
	 */
	private $salesQuantityPriceX;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"crud"})
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
     * Set code
     *
     * @param string $code
     *
     * @return Settings
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
     * @return Settings
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
     * @return Settings
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
	 * @return string
	 */
	public function getClassName() //: string
	{
		return $this->className;
	}
	
	/**
	 * @param string $className
	 */
	public function setClassName(string $className)
	{
		$this->className = $className;
	}

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Settings
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
     * @return Settings
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
     * @return Settings
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
     * @return Settings
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
     * @return Settings
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
	 * @return string
	 */
	public function getClassValue() //: string
	{
		return $this->classValue;
	}
	
	/**
	 * @param string $classValue
	 */
	public function setClassValue(string $classValue)
	{
		$this->classValue = $classValue;
	}
	
	/**
	 * @return string
	 */
	public function getSystemEmail() //: string
	{
		return $this->systemEmail;
	}
	
	/**
	 * @param string $systemEmail
	 */
	public function setSystemEmail(string $systemEmail)
	{
		$this->systemEmail = $systemEmail;
	}
	
	/**
	 * @return float
	 */
	public function getSalesQuantity() //: float
	{
		return $this->salesQuantity;
	}
	
	/**
	 * @param float $salesQuantity
	 */
	public function setSalesQuantity(float $salesQuantity)
	{
		$this->salesQuantity = $salesQuantity;
	}
	
	/**
	 * @return int
	 */
	public function getSalesQuantityPriceX() //: int
	{
		return $this->salesQuantityPriceX;
	}
	
	/**
	 * @param int $salesQuantityPriceX
	 */
	public function setSalesQuantityPriceX(int $salesQuantityPriceX)
	{
		$this->salesQuantityPriceX = $salesQuantityPriceX;
	}
	
	/**
	 * @return string
	 */
	public function getPrinterFilename() //: string
	{
		return $this->printerFilename;
	}
	
	/**
	 * @param string $printerFilename
	 */
	public function setPrinterFilename(string $printerFilename)
	{
		$this->printerFilename = $printerFilename;
	}
 
	
}

