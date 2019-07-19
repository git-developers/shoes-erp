<?php

declare(strict_types=1);

namespace Bundle\TreeBundle\Templating\Helper;

use Component\Tree\Definition\Action;
use Component\Tree\Definition\Field;
use Component\Tree\Definition\Filter;
use Component\Tree\Renderer\TreeRendererInterface;
use Component\Tree\View\TreeView;
use Bundle\CoreBundle\Services\Button;
use Symfony\Component\Templating\Helper\Helper;

class TreeHelper extends Helper
{
    /**
     * @var TreeRendererInterface
     */
    private $gridRenderer;

    /**
     * @param TreeRendererInterface $gridRenderer
     */
    public function __construct(TreeRendererInterface $gridRenderer)
    {
        $this->gridRenderer = $gridRenderer;
    }

    //        JAFETH
    public function renderModalFooter(string $template = null)
    {
        return $this->gridRenderer->renderModalFooter($template);
    }

    //        JAFETH
    public function renderButton(Button $button, string $template = null)
    {
        return $this->gridRenderer->renderButton($button, $template);
    }

    /**
     * @param TreeView $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function renderTree(TreeView $gridView, string $template = null)
    {
        //JAFETH
        return $this->gridRenderer->render($gridView, $template);
    }

    /**
     * @param TreeView $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(TreeView $gridView, Field $field, $data)
    {
        return $this->gridRenderer->renderField($gridView, $field, $data);
    }

    /**
     * @param TreeView $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(TreeView $gridView, Action $action, $data = null)
    {
        return $this->gridRenderer->renderAction($gridView, $action, $data);
    }

    /**
     * @param TreeView $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(TreeView $gridView, Filter $filter)
    {
        return $this->gridRenderer->renderFilter($gridView, $filter);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'sylius_grid';
    }
}
