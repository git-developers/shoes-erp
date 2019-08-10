<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use JMS\Serializer\Annotation\Type as TypeJMS;


class PointofsaleAddUser
{

    private $userTag;

    private $userTagUsername;

    private $profile;

    /**
     * @return mixed
     */
    public function getUserTag()
    {
        return $this->userTag;
    }

    /**
     * @param mixed $userTag
     */
    public function setUserTag($userTag)
    {
        $this->userTag = $userTag;
    }

    /**
     * @return mixed
     */
    public function getUserTagUsername()
    {
        return $this->userTagUsername;
    }

    /**
     * @param mixed $userTagUsername
     */
    public function setUserTagUsername($userTagUsername)
    {
        $this->userTagUsername = $userTagUsername;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }



//    /**
//     * @return \Bundle\ProfileBundle\Entity\Profile
//     */
//    public function getProfile()
//    {
//        return $this->profile;
//    }
//
//    /**
//     * @param \Bundle\ProfileBundle\Entity\Profile $profile
//     */
//    public function setProfile(\Bundle\ProfileBundle\Entity\Profile $profile)
//    {
//        $this->profile = $profile;
//    }

}

