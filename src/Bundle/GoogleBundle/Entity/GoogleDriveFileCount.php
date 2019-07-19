<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;

/**
 * GoogleDriveFileCount
 */
class GoogleDriveFileCount
{

    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $fileId;

    /**
     * @var integer
     *
     */
    private $countShare;

    /**
     * @var integer
     *
     */
    private $countView;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return GoogleDriveFileCount
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

}

