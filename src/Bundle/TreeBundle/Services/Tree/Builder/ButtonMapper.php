<?php

namespace Bundle\TreeBundle\Services\Tree\Builder;

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

        foreach ($buttons as $key => $button){
            $out[$button] = $this->$button();
        }

        return $out;
    }

    private function create()
    {
        return new Button([
            'alt' => 'Crear item',
            'title' => 'Crear item',
            'icon' => '<i class="fa fa-fw fa-plus"></i>',
            'data-target' => ModalMapper::CREATE_ID,
            'class' => 'btn-success ' . ModalMapper::CREATE_ID,
        ]);
    }

    private function edit()
    {
        return new Button([
            'alt' => 'Editar',
            'title' => 'Editar',
            'icon' => '<i class="fa fa-fw fa-pencil"></i>',
            'data-target' => ModalMapper::EDIT_ID,
            'class' => 'btn-warning ' . ModalMapper::EDIT_ID,
        ]);
    }

    private function delete()
    {
        return new Button([
            'alt' => 'Eliminar',
            'title' => 'Eliminar',
            'icon' => '<i class="fa fa-fw fa-trash"></i>',
            'data-target' => ModalMapper::DELETE_ID,
            'class' => 'btn-danger ' . ModalMapper::DELETE_ID,
        ]);
    }

    private function info()
    {
        return new Button([
            'alt' => 'Info',
            'title' => 'Info',
            'data-target' => ModalMapper::INFO_ID,
            'icon' => '<i class="fa fa-fw fa-info-circle"></i>',
            'class' => 'btn-info ' . ModalMapper::INFO_ID,
        ]);
    }

}



