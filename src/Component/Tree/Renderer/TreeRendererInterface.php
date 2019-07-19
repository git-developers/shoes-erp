<?php

declare(strict_types=1);

namespace Component\Tree\Renderer;

use Component\Tree\Definition\Action;
use Component\Tree\Definition\Field;
use Component\Tree\Definition\Filter;
use Component\Tree\View\TreeViewInterface;
use Bundle\CoreBundle\Services\Button;

interface TreeRendererInterface
{

    // JAFETH
    public function renderModalFooter(string $template = null); // Button $button,

    public function renderButton(Button $button, string $template = null);
    // JAFETH


    /**
     * @param TreeViewInterface $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function render(TreeViewInterface $gridView, string $template = null);

    /**
     * @param TreeViewInterface $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(TreeViewInterface $gridView, Field $field, $data);

    /**
     * @param TreeViewInterface $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(TreeViewInterface $gridView, Action $action, $data = null);

    /**
     * @param TreeViewInterface $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(TreeViewInterface $gridView, Filter $filter);
}
