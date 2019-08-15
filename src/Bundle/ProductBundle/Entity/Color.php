<?php
	
declare(strict_types=1);

namespace Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Color
 *
 */
class Color
{
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
     *     "sales",
     *     "orders",
     *     "pdv_product",
     * })
     */
    private $name;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({
	 *     "crud",
	 *     "sales",
	 *     "orders",
	 *     "pdv_product",
	 * })
	 */
	private $prefix;
	
	/**
	 * @var string
	 */
	private $slug;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({
     *     "crud",
     * })
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
     * @return Color
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
	public function setSlug(string $slug)//: void
	{
		$this->slug = $slug;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPrefix() //: string
	{
		return $this->prefix;
	}
	
	/**
	 * @param string $prefix
	 */
	public function setPrefix(string $prefix) //: void
	{
		$this->prefix = $prefix;
		
		return $this;
	}
	
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Color
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
     * @return Color
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
     * @return Color
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
