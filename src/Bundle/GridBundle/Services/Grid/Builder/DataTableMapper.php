<?php

namespace Bundle\GridBundle\Services\Grid\Builder;

class DataTableMapper
{

    const ROUTE = 'route';
    const COLUMN = 'columns';
    const DATATABLE = 'data_table';
    const TABLE_BUTTON = 'table_button';
    const TABLE_OPTION = 'table_option';
    const TABLE_BUTTON_HEADER = 'table_button_header';
    const ROW_CALL_BACK = 'row_call_back';

    const TABLE_NAME = 'table-grid';
    const TABLE_TR_CLASS = 'row-tr-class';
    const TABLE_TD_CLASS = 'row-td-class-';

    private $grid;

    public $data;
    public $route;
    public $options;
    public $columns;
    public $rowCallBack;
    public $tableOptions;
    public $tableOption;
    public $columnsTargets;
    public $tableHeaderButton;

    public function __construct(array $grid = [])
    {
        $this->grid = $grid;
        $this->columns = [];
        $this->tableButton = [];
        $this->data = json_encode([]);
    }

    /**
     * @param mixed $rowCallBack
     */
    public function setRowCallBack()
    {

        if (!isset($this->grid[self::DATATABLE][self::ROW_CALL_BACK])) {
            $this->rowCallBack = [];

            return $this;
        }

        $this->rowCallBack = $this->grid[self::DATATABLE][self::ROW_CALL_BACK];

        return $this;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param mixed $options
     */
    public function setOptions()
    {

        if (!isset($this->grid[self::DATATABLE][self::TABLE_OPTION])) {

            return $this;
        }

        $this->options = array_replace(
            [
                'pageLength' => 10,
                'lengthMenu' => json_encode([
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, 'Todos']
                ]),
                'order' => json_encode([
                    [
                        1, 'desc'
                    ]
                ]),
                'dom' => '\'<"top"iflp><"clear">rt<"bottom"iflp>\'',
                'ordering' => true,
                'paging' => true,
                'info' => true,
                'autoWidth' => true,
                'filter' => true,
            ], $this->grid[self::DATATABLE][self::TABLE_OPTION]);

        return $this;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns()
    {
        if (!isset($this->grid[self::DATATABLE][self::COLUMN])) {

            return $this;
        }

        $this->columns = $this->grid[self::DATATABLE][self::COLUMN];

        return $this;
    }

    /**
     * @param mixed $tableOptions
     */
    public function setTableOptions(array $tableOptions = [])
    {
        $this->tableOptions = array_replace([
            'table_name' => self::TABLE_NAME,
            'table_tr_class' => self::TABLE_TR_CLASS,
            'table_td_class' => self::TABLE_TD_CLASS,
        ], $tableOptions);

        return $this;
    }

    /**
     * @param mixed $columnsTargets
     */
    public function setColumnsTargets()
    {
        $columnsCount = count($this->columns) - 1;
        $columnsCount = range(0, $columnsCount);
        $columnsCount = json_encode($columnsCount);

        $this->columnsTargets = $columnsCount;

        return $this;
    }

    /**
     * @param array $tableButtons
     */
    public function setTableButton(array $tableButtons = [])
    {
        $mapper = new ButtonMapper($this->grid);
        $this->tableButton = $mapper->getTableButton();

        return $this;
    }

    /**
     * @param mixed $tableHeaderButtons
     */
    public function setTableHeaderButton(array $tableHeaderButtons = [])
    {
        $mapper = new ButtonMapper($this->grid);
        $this->tableHeaderButton = $mapper->getTableHeaderButton();

        return $this;
    }

    /**
     * @param mixed $route
     */
    public function setRoute()
    {
        if (!isset($this->grid[self::DATATABLE][self::ROUTE])) {

            return $this;
        }

        $this->route = $this->grid[self::DATATABLE][self::ROUTE];

        return $this;
    }

    public function resetGridVariable()
    {
        $this->grid = null;

        return $this;
    }
}
