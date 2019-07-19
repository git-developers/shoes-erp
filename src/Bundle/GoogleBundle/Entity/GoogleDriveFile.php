<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * GoogleDriveFile
 */
class GoogleDriveFile
{

    const GOOGLE_FOLDER = 'application/vnd.google-apps.folder';

    const MIME_TYPES = [
        'application/vnd.google-apps.audio' => 'file-audio-o',
        'application/vnd.google-apps.document' => 'file-text',
        'application/vnd.google-apps.drawing' => 'object-group',
        'application/vnd.google-apps.file' => '',
        'application/vnd.google-apps.folder' => 'folder',
        'application/vnd.google-apps.form' => '',
        'application/vnd.google-apps.fusiontable' => '',
        'application/vnd.google-apps.map' => '',
        'application/vnd.google-apps.photo' => 'image',
        'image/png' => 'image',
        'image/jpeg' => 'image',
        'image/x-icon' => 'file-image-o',
        'application/vnd.google-apps.presentation' => 'file-powerpoint-o',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'file-powerpoint-o',
        'application/vnd.google-apps.script' => 'code',
        'application/vnd.google-apps.sites' => '',
        'application/vnd.google-apps.spreadsheet' => 'file-excel-o',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'file-excel-o',
        'application/vnd.google-apps.unknown' => 'file-o',
        'application/vnd.google-apps.video' => 'file-video-o',
        'video/mp4' => 'file-video-o',
        'application/gzip' => 'file-zip-o',
        'application/x-rar' => 'file-zip-o',
        'application/x-compressed-tar' => 'file-zip-o',
        'application/pdf' => 'file-pdf-o',
        'application/msword' => 'file-word-o',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'file-word-o',
        'application/vnd.mysql-workbench-model' => 'code',
        'application/x-httpd-php' => 'code',
        'application/sql' => 'code',
        'application/vnd.ms-project' => 'code',
    ];

    const MIME_TYPES_VIEWER = [
        'application/vnd.google-apps.audio' => 'file-audio-o',
        'application/vnd.google-apps.document' => 'google_viewer',
        'application/vnd.google-apps.drawing' => 'object-group',
        'application/vnd.google-apps.file' => '',
        'application/vnd.google-apps.folder' => 'folder',
        'application/vnd.google-apps.form' => '',
        'application/vnd.google-apps.fusiontable' => '',
        'application/vnd.google-apps.map' => '',
        'application/vnd.google-apps.photo' => 'image',
        'image/png' => 'image',
        'image/jpeg' => 'image',
        'image/x-icon' => 'file-image-o',
        'application/vnd.google-apps.presentation' => 'google_viewer',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'google_viewer',
        'application/vnd.google-apps.script' => 'code',
        'application/vnd.google-apps.sites' => '',
        'application/vnd.google-apps.spreadsheet' => 'google_viewer',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'google_viewer',
        'application/vnd.google-apps.unknown' => 'file-o',
        'application/vnd.google-apps.video' => 'video',
        'video/mp4' => 'video',
        'video/x-msvideo' => 'video',
        'application/gzip' => 'zip',
        'application/x-rar' => 'zip',
        'application/x-compressed-tar' => 'zip',
        'application/pdf' => 'google_viewer',
        'application/msword' => 'google_viewer',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'google_viewer',
        'application/vnd.mysql-workbench-model' => 'code',
        'application/x-httpd-php' => 'code',
        'application/sql' => 'code',
        'application/vnd.ms-project' => 'code',
    ];

    /**
     * @var integer
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $id;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $uniqueId;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $slug;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $description;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $fileId;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $fileMimeType;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $fileMimeTypeShort;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $fileIconLink;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $fileName;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $fileNameOriginal;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $fileSize;

    /**
     * @var string
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $fileImage;

    /**
     * @var boolean
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $hasThumbnail = '0';

    /**
     * @var integer
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $countShare;

    /**
     * @var integer
     *
     * @JMSS\Groups({"google-drive-file"})
     */
    private $countView;

    /**
     * @var \DateTime
     *
     * @JMSS\Groups({"google-drive-file"})
     * @JMSS\Type("DateTime<'Y-m-d H:i:s'>")
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
    private $isActive = '1';

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
     * Set id
     *
     * @param integer $id
     *
     * @return GoogleDriveFile
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set uniqueId
     *
     * @param string $uniqueId
     *
     * @return GoogleDriveFile
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    /**
     * Get uniqueId
     *
     * @return string
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return GoogleDriveFile
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Set fileId
     *
     * @param string $fileId
     *
     * @return GoogleDriveFile
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;

        return $this;
    }

    /**
     * Get fileId
     *
     * @return string
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * Set fileMimeType
     *
     * @param string $fileMimeType
     *
     * @return GoogleDriveFile
     */
    public function setFileMimeType($fileMimeType)
    {
        $this->fileMimeType = $fileMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileMimeTypeShort()
    {
        return $this->fileMimeTypeShort;
    }

    /**
     * @param string $fileMimeTypeShort
     */
    public function setFileMimeTypeShort($fileMimeTypeShort)
    {
        $this->fileMimeTypeShort = isset(self::MIME_TYPES[$fileMimeTypeShort]) ? self::MIME_TYPES[$fileMimeTypeShort] : '';;
    }

    /**
     * Get fileMimeType
     *
     * @return string
     */
    public function getFileMimeType()
    {
        return $this->fileMimeType;
    }

    /**
     * Set fileIconLink
     *
     * @param string $fileIconLink
     *
     * @return GoogleDriveFile
     */
    public function setFileIconLink($fileIconLink)
    {
        $this->fileIconLink = $fileIconLink;

        return $this;
    }

    /**
     * Get fileIconLink
     *
     * @return string
     */
    public function getFileIconLink()
    {
        return $this->fileIconLink;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return GoogleDriveFile
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getFileNameOriginal()
    {
        return $this->fileNameOriginal;
    }

    /**
     * @param string $fileNameOriginal
     */
    public function setFileNameOriginal($fileNameOriginal)
    {
        $this->fileNameOriginal = $fileNameOriginal;
    }

    /**
     * Set fileSize
     *
     * @param string $fileSize
     *
     * @return GoogleDriveFile
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return string
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @return string
     */
    public function getFileImage()
    {
        return $this->fileImage;
    }

    /**
     * @param string $fileImage
     */
    public function setFileImage(string $fileImage)
    {
        $this->fileImage = $fileImage;
    }

    /**
     * @return bool
     */
    public function isHasThumbnail(): bool
    {
        return $this->hasThumbnail;
    }

    /**
     * @param bool $hasThumbnail
     */
    public function setHasThumbnail(bool $hasThumbnail)
    {
        $this->hasThumbnail = $hasThumbnail;
    }

    /**
     * @return int
     */
    public function getCountShare()
    {
        return $this->countShare;
    }

    /**
     * @param int $countShare
     */
    public function setCountShare(int $countShare)
    {
        $this->countShare = $countShare;
    }

    /**
     * @return int
     */
    public function getCountView()
    {
        return $this->countView;
    }

    /**
     * @param int $countView
     */
    public function setCountView(int $countView)
    {
        $this->countView = $countView;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return GoogleDriveFile
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
     * @return GoogleDriveFile
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
     * @return GoogleDriveFile
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
     * Set user
     *
     * @param \Bundle\UserBundle\Entity\User $user
     *
     * @return GoogleDriveFile
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

