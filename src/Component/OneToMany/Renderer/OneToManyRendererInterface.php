<?php

declare(strict_types=1);

namespace Component\OneToMany\Renderer;

use Component\OneToMany\Definition\Action;
use Component\OneToMany\Definition\Field;
use Component\OneToMany\Definition\Filter;
use Component\OneToMany\View\OneToManyViewInterface;
use Bundle\CoreBundle\Services\Button;

interface OneToManyRendererInterface
{

    // JAFETH
    public function renderModalFooter(string $template = null); // Button $button,
    public function renderButton(Button $button, string $template = null);
    public function boxRightIsAssigned(array $oneToManyLeft = [], $id);
    // JAFETH


    /**
     * @param OneToManyViewInterface $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function render(OneToManyViewInterface $gridView, string $template = null);

    /**
     * @param OneToManyViewInterface $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(OneToManyViewInterface $gridView, Field $field, $data);

    /**
     * @param OneToManyViewInterface $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(OneToManyViewInterface $gridView, Action $action, $data = null);

    /**
     * @param OneToManyViewInterface $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(OneToManyViewInterface $gridView, Filter $filter);
}
