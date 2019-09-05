<?php
	
declare(strict_types=1);

namespace Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Unit
 *
 */
class Unit
{
	
	
	const PAQUETE_12_ID = 2;
	const PAQUETE_12 = 'paquete_12';
	
	const UNIDAD_ID = 1;
	const UNIDAD = 'unidad';
	
	
    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     *     "sales",
     * })
     */
    private $id;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud"})
     */
    private $name;

    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     *     "sales",
     * })
     */
    private $unitValue;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({"crud"})
	 */
	private $slug;

    /**
     * @var \DateTime
     *
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
    private $isActive;
	
	public function __toString() {
		return sprintf('%s', $this->name);
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
     * @return Unit
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
	 * @return int
	 */
	public function getUnitValue()
	{
		return $this->unitValue;
	}
	
	/**
	 * @param int $unitValue
	 */
	public function setUnitValue(int $unitValue)
	{
		$this->unitValue = $unitValue;
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
     * @return Unit
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
     * @return Unit
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
     * @return Unit
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
