<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PointofsaleOpening
 */
class PointofsaleOpening
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
     * @var \DateTime
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     */
    private $openingDate;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"crud"})
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     */
    private $closingDate;
	
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
	 * @var \Bundle\PointofsaleBundle\Entity\Pointofsale
	 *
	 * @ORM\ManyToOne(targetEntity="Bundle\PointofsaleBundle\Entity\Pointofsale")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id")
	 * })
	 */
	private $pointOfSale;

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
     * @return Client
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
	
	/**
	 * @return \DateTime
	 */
	public function getClosingDate() //: \DateTime
	{
		return $this->closingDate;
	}
	
	/**
	 * @param \DateTime $closingDate
	 */
	public function setClosingDate(\DateTime $closingDate)
	{
		$this->closingDate = $closingDate;
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
	 * Set pointOfSale
	 *
	 * @param \Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale
	 *
	 * @return PointofsaleOpening
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
