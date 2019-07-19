<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Renderer;

use Component\TreeOneToMany\Definition\Action;
use Component\TreeOneToMany\Definition\Field;
use Component\TreeOneToMany\Definition\Filter;
use Component\TreeOneToMany\View\TreeOneToManyViewInterface;
use Bundle\CoreBundle\Services\Button;

interface TreeOneToManyRendererInterface
{

    // JAFETH
    public function renderModalFooter(string $template = null); // Button $button,
    public function renderButton(Button $button, string $template = null);
    public function boxRightIsAssigned(array $oneToManyLeft = [], $id);
    // JAFETH


    /**
     * @param TreeOneToManyViewInterface $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function render(TreeOneToManyViewInterface $gridView, string $template = null);

    /**
     * @param TreeOneToManyViewInterface $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(TreeOneToManyViewInterface $gridView, Field $field, $data);

    /**
     * @param TreeOneToManyViewInterface $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(TreeOneToManyViewInterface $gridView, Action $action, $data = null);

    /**
     * @param TreeOneToManyViewInterface $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(TreeOneToManyViewInterface $gridView, Filter $filter);
}
