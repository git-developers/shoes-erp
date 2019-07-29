<?php

namespace Bundle\RoleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Role
 */
class Role
{
	
	const ROLE_VIEW = 'ROLE_VIEW';
	const ROLE_CREATE = 'ROLE_CREATE';
	const ROLE_EDIT = 'ROLE_EDIT';
	const ROLE_DELETE = 'ROLE_DELETE';
	
	const ROLE_STADISTICS = 'ROLE_STADISTICS';
	const ROLE_SETTINGS = 'ROLE_SETTINGS';
	const ROLE_UPLOAD_IMAGE = 'ROLE_UPLOAD_IMAGE';

    /**
     * @var integer
     *
     * @JMSS\Groups({"crud", "login", "one-to-many-left", "one-to-many-right", "one-to-many-left-profilehasrole", "one-to-many-search"})
     */
    private $id;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "login"})
     */
    private $code;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "login"})
     */
    private $name;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "login"})
     */
    private $slug;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "login"})
     */
    private $groupRol;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "login"})
     */
    private $groupRolTag;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Bundle\ProfileBundle\Entity\Profile", mappedBy="role")
     *
     */
    private $profile;

    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({"one-to-many-left", "one-to-many-right", "one-to-many-left-profilehasrole"})
     */
    private $nameBox;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->profile = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set code
     *
     * @param string $code
     *
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * Set groupRol
     *
     * @param string $groupRol
     *
     * @return Role
     */
    public function setGroupRol($groupRol)
    {
        $this->groupRol = $groupRol;

        return $this;
    }

    /**
     * Get groupRol
     *
     * @return string
     */
    public function getGroupRol()
    {
        return $this->groupRol;
    }

    /**
     * Set groupRolTag
     *
     * @param string $groupRolTag
     *
     * @return Role
     */
    public function setGroupRolTag($groupRolTag)
    {
        $this->groupRolTag = $groupRolTag;

        return $this;
    }

    /**
     * Get groupRolTag
     *
     * @return string
     */
    public function getGroupRolTag()
    {
        return $this->groupRolTag;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * Add profile
     *
     * @param \Bundle\ProfileBundle\Entity\Profile $profile
     *
     * @return Role
     */
    public function addProfile(\Bundle\ProfileBundle\Entity\Profile $profile)
    {
        $this->profile[] = $profile;

        return $this;
    }

    /**
     * Remove profile
     *
     * @param \Bundle\ProfileBundle\Entity\Profile $profile
     */
    public function removeProfile(\Bundle\ProfileBundle\Entity\Profile $profile)
    {
        $this->profile->removeElement($profile);
    }

    /**
     * Get profile
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfile()
    {
        return $this->profile;
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
}

