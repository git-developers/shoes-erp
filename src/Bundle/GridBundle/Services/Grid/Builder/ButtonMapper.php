<?php

namespace Bundle\GridBundle\Services\Grid\Builder;

use Bundle\CoreBundle\Services\Button;
use Bundle\CoreBundle\Services\ModalMapper;
use Symfony\Component\Debug\Exception\UndefinedMethodException;

class ButtonMapper
{

    private $grid;
    protected $buttons;

    public function __construct(array $grid = [])
    {
        $this->grid = $grid;
    }

    public function getTableHeaderButton()
    {
        if (!isset($this->grid[DataTableMapper::DATATABLE][DataTableMapper::TABLE_BUTTON_HEADER])) {
            return [];
        }

        $out = [];
        $buttons = $this->grid[DataTableMapper::DATATABLE][DataTableMapper::TABLE_BUTTON_HEADER];

        foreach ($buttons as $key => $button){
            $out[$button] = $this->$button();
        }

        return $out;
    }

    public function getTableButton()
    {
        if (!isset($this->grid[DataTableMapper::DATATABLE][DataTableMapper::TABLE_BUTTON])) {
            return [];
        }

        $out = [];
        $buttons = $this->grid[DataTableMapper::DATATABLE][DataTableMapper::TABLE_BUTTON];

        foreach ($buttons as $key => $button) {

            try {

                $out[$button] = $this->$button();

            } catch (\Throwable $e) {

            }
        }

        return $out;
    }

    private function create()
    {
        return new Button([
            'alt' => 'Crear item',
            'title' => 'Crear item',
            'icon' => '<i class="fa fa-fw fa-plus"></i>',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::CREATE_ID,
            'class' => 'btn-sm btn-success ' . ModalMapper::CREATE_ID,
        ]);
    }

    private function create_pdv_child()
    {
        return new Button([
            'alt' => 'Crear item',
            'title' => 'Crear item',
            'icon' => '<i class="fa fa-fw fa-plus"></i>',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::CREATE_ID,
            'class' => 'btn-sm btn-success ' . ModalMapper::CREATE_ID,
        ]);
    }

    private function edit()
    {
        return new Button([
            'alt' => 'Editar',
            'title' => 'Editar',
            'icon' => '<i class="fa fa-fw fa-pencil"></i>',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::EDIT_ID,
            'class' => 'btn-xs btn-warning btn-margin-5 ' . ModalMapper::EDIT_ID,
        ]);
    }

    private function delete()
    {
        return new Button([
            'alt' => 'Eliminar',
            'title' => 'Eliminar',
            'icon' => '<i class="fa fa-fw fa-trash"></i>',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::DELETE_ID,
            'class' => 'btn-xs btn-danger btn-margin-5 ' . ModalMapper::DELETE_ID,
        ]);
    }

    private function info()
    {
        return new Button([
            'alt' => 'Info',
            'title' => 'Info',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::INFO_ID,
            'icon' => '<i class="fa fa-fw fa-info-circle"></i>',
            'class' => 'btn-sm btn-info ' . ModalMapper::INFO_ID,
        ]);
    }

    private function watch()
    {
        return new Button([
            'alt' => 'Ver archivo',
            'title' => 'Ver archivo',
            'icon' => '<i class="fa fa-fw fa-eye"></i>',
            'class' => 'btn-sm btn-info ' . ModalMapper::WATCH_ID,
        ]);
    }

    private function view_profile()
    {
        return new Button([
            'alt' => 'Ver perfil',
            'title' => 'Ver perfil',
            'icon' => '<i class="fa fa-fw fa-eye"></i>',
            'class' => 'btn-xs bg-olive ' . ModalMapper::PROFILE_ID,
        ]);
    }

    private function ticket_edit()
    {
        return new Button([
            'alt' => 'Editar ticket',
            'title' => 'Editar ticket',
            'icon' => '<i class="fa fa-fw fa-pencil"></i>',
            'class' => 'btn btn-xs btn-warning ' . ModalMapper::TICKET_EDIT_ID,
        ]);
    }
	
	private function cog()
	{
		return new Button([
			'alt' => 'Settings',
			'title' => 'Settings',
			'icon' => '<i class="fa fa-fw fa-cog"></i>',
			'class' => 'btn-xs btn-primary btn-margin-5 ' . ModalMapper::POINT_OF_SALE_COG,
		]);
	}
	
	private function image_upload()
	{
		return new Button([
			'alt' => 'Crear imagen',
			'title' => 'Crear imagen',
			'icon' => '<i class="fa fa-fw fa-image"></i>',
			'data-toggle' => 'modal',
			'data-target' => ModalMapper::IMAGE_UPLOAD,
			'class' => 'btn-xs bg-purple ' . ModalMapper::IMAGE_UPLOAD,
		]);
	}
	
	private function files_upload()
	{
		return new Button([
			'alt' => 'Subir archivo',
			'title' => 'Subir archivo',
			'icon' => '<i class="fa fa-fw fa-image"></i>',
			'data-toggle' => 'modal',
			'data-target' => ModalMapper::FILES_UPLOAD,
			'class' => 'btn-xs bg-purple ' . ModalMapper::FILES_UPLOAD,
		]);
	}

    private function change_password()
    {
        return new Button([
            'alt' => 'Cambiar password',
            'title' => 'Cambiar password',
            'icon' => '<i class="fa fa-fw fa-lock"></i>',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::CHANGE_PASSWORD_ID,
            'class' => 'btn-xs btn-info btn-margin-5 ' . ModalMapper::CHANGE_PASSWORD_ID,
        ]);
    }

}



