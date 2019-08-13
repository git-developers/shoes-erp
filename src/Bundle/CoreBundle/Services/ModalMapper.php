<?php

namespace Bundle\CoreBundle\Services;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class ModalMapper
{

    protected $defaults;

    const TITLE = 'Crear item';
    const SIZE_LARGE = 'modal-lg';

    const CREATE_ID = 'modal-create';
    const CREATE_CHILD_ID = 'modal-create-child';

    const EDIT_ID = 'modal-edit';
    const DELETE_ID = 'modal-delete';
    const VIEW_ID = 'modal-view';
    const PAYMENT_HISTORY_ID = 'modal-payment-history';
    const INFO_ID = 'modal-info';
    const WATCH_ID = 'watch-button-id';
    const PROFILE_ID = 'profile-button-id';
    const TICKET_EDIT_ID = 'ticket-edit-id';
    
    const FILES_UPLOAD = 'files-upload';
    const IMAGE_UPLOAD = 'image-upload';

    const POINT_OF_SALE_COG = 'pointofsale-cog';
    const CHANGE_PASSWORD_ID = 'change-password-id';

    public function __construct(Router $router)
    {

        $this->defaults = [

            'title' => self::TITLE,

            'edit_id' => self::EDIT_ID,
            'edit_size' => null,

            'delete_id' => self::DELETE_ID,
            'delete_size' => null,

            'create_id' => self::CREATE_ID,
            'create_size' => null,
            'create_child_id' => self::CREATE_CHILD_ID,
            'create_child_size' => null,

            'view_id' => self::VIEW_ID,
            'view_size' => null,

            'payment_history_id' => self::PAYMENT_HISTORY_ID,
            'payment_history_size' => null,

            'info_id' => self::INFO_ID,
            'info_size' => self::SIZE_LARGE,

            'watch_id' => self::WATCH_ID,
            'ticket_edit_id' => self::TICKET_EDIT_ID,
            'profile_id' => self::PROFILE_ID,

            'point_of_sale_cog' => self::POINT_OF_SALE_COG,

            'change_password_id' => self::CHANGE_PASSWORD_ID,
            'change_password_size' => null,
	        
            'files_upload_id' => self::FILES_UPLOAD,
            'files_upload_size' => null,
	        
            'image_upload_id' => self::IMAGE_UPLOAD,
            'image_upload_size' => null,
        ];
    }

    public function getDefaults(array $defaults = [])
    {
        return array_replace($this->defaults, $defaults);
    }

}



