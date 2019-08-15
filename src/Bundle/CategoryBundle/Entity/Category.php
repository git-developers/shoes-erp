<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Category
 *
 * @UniqueEntity(
 *     fields={"code"},
 *     message="El codigo fue registrado anteriormente"
 * )
 */
class Category
{
	
	const ROLE_CATEGORY_VIEW = 'ROLE_CATEGORY_VIEW';
	const ROLE_CATEGORY_CREATE = 'ROLE_CATEGORY_CREATE';
	const ROLE_CATEGORY_EDIT = 'ROLE_CATEGORY_EDIT';
	const ROLE_CATEGORY_DELETE = 'ROLE_CATEGORY_DELETE';

    const TYPE_PRODUCT_ID = 1;
    const TYPE_PRODUCT = 'PRODUCT';

    const TYPE_SERVICE_ID = 2;
    const TYPE_SERVICE = 'SERVICE';

    const TYPES = [
        self::TYPE_PRODUCT,
        self::TYPE_SERVICE,
    ];

    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     *     "tree",
     *     "tree-one-to-many-left",
     *     "api",
     *     "sales",
     *     "orders"
     * })
     */
    private $id;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "tree", "tree-one-to-many-left", "api"})
     */
    private $code;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "tree", "api"})
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "tree", "api"})
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"crud", "tree"})
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
     * @var \Bundle\CategoryBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Bundle\CategoryBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     *
     */
    private $category;

    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({"tree-one-to-many-left"})
     */
    private $nameBox;
	
	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\ManyToMany(targetEntity="Bundle\PointofsaleBundle\Entity\Pointofsale", mappedBy="category")
	 */
	private $pointOfSale;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->pointOfSale = new \Doctrine\Common\Collections\ArrayCollection();
	}

    public function __toString() {
        return sprintf('%s - %s', $this->id, $this->name);
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
     * @return Category
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
     * @return Category
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
     * @return Category
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Category
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
     * @return Category
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
     * @return Category
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
     * @return Category
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
     * @return Category
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
     * Set category
     *
     * @param \Bundle\CategoryBundle\Entity\Category $category
     *
     * @return Category
     */
    public function setCategory(\Bundle\CategoryBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Bundle\CategoryBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     *
     * @return string
     */
    public function getNameBox()
    {
        return sprintf('%s', $this->name);
    }

    /**
     * @param string $nameBox
     */
    public function setNameBox($nameBox)
    {
        $this->nameBox = $nameBox;
    }

    static public function isEntityType($type)
    {
        $type = strtoupper($type);
        return in_array($type,self::TYPES);
    }
	
	/**
	 * Add pointOfSale
	 *
	 * @param \Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale
	 *
	 * @return Category
	 */
	public function addPointOfSale(\Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale)
	{
		$this->pointOfSale[] = $pointOfSale;
		
		return $this;
	}
	
	/**
	 * Remove pointOfSale
	 *
	 * @param \Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale
	 */
	public function removePointOfSale(\Bundle\PointofsaleBundle\Entity\Pointofsale $pointOfSale)
	{
		$this->pointOfSale->removeElement($pointOfSale);
	}
	
	/**
	 * Get pointOfSale
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPointOfSale()
	{
		return $this->pointOfSale;
	}
}

