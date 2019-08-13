<?php

namespace Bundle\CoreBundle\Services;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

//class FormMapper extends Base
class FormMapper
{

    protected $defaults;

    const CREATE_NAME = 'form-create';
    const CREATE_PAYMENT_HISTORY = 'form-payment-history';
    const CREATE_CHILD_NAME = 'form-create-child';
    const EDIT_NAME = 'form-edit';
    const DELETE_NAME = 'form-delete';
    const DELETE_INPUT_ID = 'input-role-id';
    const CHANGE_PASSWORD_NAME = 'form-change-password';
    const IMAGE_UPLOAD_NAME = 'form-image-upload';
    const FILE_UPLOAD_NAME = 'form-file-upload';

    public function __construct(Router $router, RequestStack $requestStack)
    {

//        parent::__construct($router, $requestStack);

        $this->defaults = [

            'create_name' => self::CREATE_NAME,
            'payment_history' => self::CREATE_PAYMENT_HISTORY,
            'create_child_name' => self::CREATE_CHILD_NAME,
            'edit_name' => self::EDIT_NAME,
            'delete_name' => self::DELETE_NAME,
            'change_password_name' => self::CHANGE_PASSWORD_NAME,
            'image_upload_name' => self::IMAGE_UPLOAD_NAME,
            'file_upload_name' => self::FILE_UPLOAD_NAME,
            'data' => [],
//            'type' => null,
        ];
    }

    public function getDefaults()
    {
        return $this->defaults;
    }

//    public function add($key, $value = null, array $options = [])
//    {
//        $this->isValidKey($key, $this->defaults);
//        $this->defaults[$key] = $value;
//        return $this;
//    }
}



