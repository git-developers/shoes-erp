<?php

declare(strict_types=1);

namespace Component\Grid\Renderer;

use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\Grid\View\GridViewInterface;
use Bundle\CoreBundle\Services\Button;
use Bundle\GridBundle\Services\Grid\Builder\DataTableMapper;

interface GridRendererInterface
{

    // JAFETH
    public function renderFormJs($vars, $modal, $formMapper, DataTableMapper $dataTable, string $template = null);

    // JAFETH
    public function renderModalFooter(string $template = null); // Button $button,

    public function renderButton(Button $button, string $template = null);
    // JAFETH


    /**
     * @param GridViewInterface $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function render(GridViewInterface $gridView, string $template = null);

    /**
     * @param GridViewInterface $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(GridViewInterface $gridView, Field $field, $data);

    /**
     * @param GridViewInterface $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(GridViewInterface $gridView, Action $action, $data = null);

    /**
     * @param GridViewInterface $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(GridViewInterface $gridView, Filter $filter);
}
