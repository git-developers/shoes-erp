<?php

declare(strict_types=1);

namespace Bundle\GridBundle\Templating\Helper;

use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\Grid\Renderer\GridRendererInterface;
use Component\Grid\View\GridView;
use Bundle\CoreBundle\Services\Button;
use Symfony\Component\Templating\Helper\Helper;
use Bundle\GridBundle\Services\Grid\Builder\DataTableMapper;

class GridHelper extends Helper
{
    /**
     * @var GridRendererInterface
     */
    private $gridRenderer;

    /**
     * @param GridRendererInterface $gridRenderer
     */
    public function __construct(GridRendererInterface $gridRenderer)
    {
        $this->gridRenderer = $gridRenderer;
    }

    //        JAFETH
    public function renderFormJs($vars, $modal, $formMapper, DataTableMapper $dataTable, string $template = null)
    {
        return $this->gridRenderer->renderFormJs($vars, $modal, $formMapper, $dataTable, $template);
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
     * @param GridView $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function renderGrid(GridView $gridView, string $template = null)
    {
        //JAFETH
        return $this->gridRenderer->render($gridView, $template);
    }

    /**
     * @param GridView $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(GridView $gridView, Field $field, $data)
    {
        return $this->gridRenderer->renderField($gridView, $field, $data);
    }

    /**
     * @param GridView $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(GridView $gridView, Action $action, $data = null)
    {
        return $this->gridRenderer->renderAction($gridView, $action, $data);
    }

    /**
     * @param GridView $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(GridView $gridView, Filter $filter)
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
