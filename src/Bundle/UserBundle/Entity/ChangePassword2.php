<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ChangePassword2
{

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 6,
     *      max = 500,
     *      minMessage = "El password nuevo debe de tener por lo menos de {{ limit }} caracteres.",
     *      maxMessage = "El password nuevo no puede tener mayor a {{ limit }} caracteres."
     * )
     */
    private $newPassword;

    /**
     * @var boolean
     *
     */
    private $togglePassword;


    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param mixed $newPassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * @return boolean
     */
    public function isTogglePassword()
    {
        return $this->togglePassword;
    }

    /**
     * @param boolean $togglePassword
     */
    public function setTogglePassword($togglePassword)
    {
        $this->togglePassword = $togglePassword;
    }

}