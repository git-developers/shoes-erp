<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * GoogleDriveFileVote
 *
 */
class GoogleDriveFileVote
{
    /**
     * @var integer
     *
     * @JMSS\Groups({"google-drive-file-vote"})
     */
    private $id;

    /**
     * @var boolean
     *
     * @JMSS\Groups({"google-drive-file-vote"})
     */
    private $vote = '0';

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"google-drive-file-vote"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"google-drive-file-vote"})
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @JMSS\Groups({"google-drive-file-vote"})
     */
    private $isActive = '1';

    /**
     * @var \Bundle\GoogleBundle\Entity\GoogleDriveFile
     *
     * @ORM\ManyToOne(targetEntity="Bundle\GoogleBundle\Entity\GoogleDriveFile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="google_drive_file_id", referencedColumnName="id")
     * })
     */
    private $googleDriveFile;

    /**
     * @var \Bundle\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * @return bool
     */
    public function isVote()
    {
        return $this->vote;
    }

    /**
     * @param bool $vote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return GoogleDriveFileVote
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
     * @return GoogleDriveFileVote
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
     * @return GoogleDriveFileVote
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
     * Set googleDriveFile
     *
     * @param \Bundle\GoogleBundle\Entity\GoogleDriveFile $googleDriveFile
     *
     * @return GoogleDriveFileVote
     */
    public function setGoogleDriveFile(\Bundle\GoogleBundle\Entity\GoogleDriveFile $googleDriveFile = null)
    {
        $this->googleDriveFile = $googleDriveFile;

        return $this;
    }

    /**
     * Get googleDriveFile
     *
     * @return \Bundle\GoogleBundle\Entity\GoogleDriveFile
     */
    public function getGoogleDriveFile()
    {
        return $this->googleDriveFile;
    }

    /**
     * Set user
     *
     * @param \Bundle\UserBundle\Entity\User $user
     *
     * @return GoogleDriveFileVote
     */
    public function setUser(\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
