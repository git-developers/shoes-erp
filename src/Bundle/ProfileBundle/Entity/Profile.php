<?php

namespace Bundle\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * Profile
 */
class Profile
{

    const SUPER_ADMIN = 'Super Administrator';
    const GUEST = 'Guest (invitado)';

    const PDV_ADMIN = 'PDV Administrator';
    const PDV_ADMIN_SLUG = 'pdv-administrator';

    const SELLER = 'Vendedor';
    const SELLER_SLUG = 'seller';

    const CLIENT = 'Cliente';
    const CLIENT_SLUG = 'client';
	
	const ROLE_PROFILE_VIEW = 'ROLE_PROFILE_VIEW';
	const ROLE_PROFILE_CREATE = 'ROLE_PROFILE_CREATE';
	const ROLE_PROFILE_EDIT = 'ROLE_PROFILE_EDIT';
	const ROLE_PROFILE_DELETE = 'ROLE_PROFILE_DELETE';

    /**
     * @var integer
     *
     * @JMSS\Groups({
     *     "crud",
     *     "login",
     *     "one-to-many-left"
     * })
     */
    private $id;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "login", "one-to-many-left"})
     */
    private $code;

    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "crud",
     *     "login",
     *     "pointofsale-has-user"
     * })
     */
    private $name;

    /**
     * @var string
     *
     * @JMSS\Groups({"crud", "login"})
     */
    private $nameCanonical;

    /**
     * @var string
     *
     * @JMSS\Groups({
     *     "crud",
     *     "pointofsale-has-user"
     * })
     */
    private $slug;

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
     * @ORM\ManyToMany(targetEntity="Bundle\RoleBundle\Entity\Role", inversedBy="profile")
     * @ORM\JoinTable(name="profile_has_role",
     *   joinColumns={
     *     @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   }
     * )
     *
     * @JMSS\Groups({"one-to-many-left-profilehasrole", "one-to-many-search", "login"})
     */
    private $role;

    /**
     * @var boolean
     *
     */
    private $toggleCheckbox;

    /**
     * @var boolean
     *
     */
    private $collapsedBox;

    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({"one-to-many-left"})
     */
    private $nameBox;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Profile
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
     * @return Profile
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
    public function getNameCanonical()
    {
        return $this->nameCanonical;
    }

    /**
     * @param string $nameCanonical
     */
    public function setNameCanonical($nameCanonical)
    {
        $this->nameCanonical = $nameCanonical;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * @return Profile
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
     * Add role
     *
     * @param \Bundle\RoleBundle\Entity\Role $role
     *
     * @return Profile
     */
    public function addRole(\Bundle\RoleBundle\Entity\Role $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Bundle\RoleBundle\Entity\Role $role
     */
    public function removeRole(\Bundle\RoleBundle\Entity\Role $role)
    {
        $this->role->removeElement($role);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return boolean
     */
    public function isToggleCheckbox()
    {
        return $this->toggleCheckbox;
    }

    /**
     * @param boolean $toggleCheckbox
     */
    public function setToggleCheckbox($toggleCheckbox)
    {
        $this->toggleCheckbox = $toggleCheckbox;
    }

    /**
     * @return boolean
     */
    public function isCollapsedBox()
    {
        return $this->collapsedBox;
    }

    /**
     * @param boolean $collapsedBox
     */
    public function setCollapsedBox($collapsedBox)
    {
        $this->collapsedBox = $collapsedBox;
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

