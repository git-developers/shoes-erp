<?php

declare(strict_types=1);

namespace Bundle\FilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Files
 */
class Files
{

	const IMAGE = 'IMAGE';
	const FILE = 'FILE';
	
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var string
     *
     */
    private $className;
	
	/**
	 * @var integer
	 *
	 */
	private $pkFileItem;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({
	 *     "crud",
	 *     "ticket"
	 * })
	 */
	private $filter;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({
	 *     "crud",
	 *     "ticket"
	 * })
	 */
	private $fileType;
	
	/**
	 * @var string
	 *
	 */
	private $mimeContentType;
	
	/**
	 * @var string
	 *
	 * @JMSS\Groups({
	 *     "crud",
	 *     "ticket"
	 * })
	 */
	private $uniqid;

    /**
     * @var \DateTime
     *
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
	 * @var string
	 *
	 * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
	 * @Assert\File(mimeTypes={ "application/pdf" })
	 */
    private $fileSelected;


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
     * @return Files
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
     * @return Files
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
     * @return Files
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
     * @return Files
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
     * @return Files
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
     * @return Files
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
	 * @return int
	 */
	public function getPkFileItem(): int
	{
		return $this->pkFileItem;
	}
	
	/**
	 * @param int $pkFileItem
	 */
	public function setPkFileItem(int $pkFileItem)
	{
		$this->pkFileItem = $pkFileItem;
	}
	
	/**
	 * @return string
	 */
	public function getFileType(): string
	{
		return $this->fileType;
	}
	
	/**
	 * @param string $fileType
	 */
	public function setFileType(string $fileType)
	{
		$this->fileType = $fileType;
	}
	
	/**
	 * @return string
	 */
	public function getUniqid(): string
	{
		return $this->uniqid;
	}
	
	/**
	 * @param string $uniqid
	 */
	public function setUniqid(string $uniqid)
	{
		$this->uniqid = $uniqid;
	}
	
	/**
	 * @return string
	 */
	public function getFileSelected()
	{
		return $this->fileSelected;
	}
	
	/**
	 * @param string $fileSelected
	 */
	public function setFileSelected(string $fileSelected)
	{
		$this->fileSelected = $fileSelected;
	}
	
	/**
	 * @return string
	 */
	public function getMimeContentType(): string
	{
		return $this->mimeContentType;
	}
	
	/**
	 * @param string $mimeContentType
	 */
	public function setMimeContentType(string $mimeContentType)
	{
		$this->mimeContentType = $mimeContentType;
	}
	
	/**
	 * @return string
	 */
	public function getFilter(): string
	{
		return $this->filter;
	}
	
	/**
	 * @param string $filter
	 */
	public function setFilter(string $filter)
	{
		$this->filter = $filter;
	}

}

