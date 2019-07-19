<?php

declare(strict_types=1);

namespace Bundle\TreeOneToManyBundle\Templating\Helper;

use Component\TreeOneToMany\Definition\Action;
use Component\TreeOneToMany\Definition\Field;
use Component\TreeOneToMany\Definition\Filter;
use Component\TreeOneToMany\Renderer\TreeOneToManyRendererInterface;
use Component\TreeOneToMany\View\TreeOneToManyView;
use Bundle\CoreBundle\Services\Button;
use Symfony\Component\Templating\Helper\Helper;

class TreeOneToManyHelper extends Helper
{
    /**
     * @var OneToManyRendererInterface
     */
    private $gridRenderer;

    /**
     * @param OneToManyRendererInterface $gridRenderer
     */
    public function __construct(TreeOneToManyRendererInterface $gridRenderer)
    {
        $this->gridRenderer = $gridRenderer;
    }

    //    JAFETH
    public function boxRightIsAssigned(array $objectsLeft = [], $id)
    {

//        echo "POLLO: 2222 :: objectsLeft: <pre>";
//        print_r($objectsLeft);
//        exit;



//        if(empty($objectsLeft)){
//            return false;
//        }
//
//        foreach (array_shift($oneToManyLeft) as $key => $value){
//            if(reset($value) === $id){
//                return true;
//            }
//        }

        return false;

//        return $this->twig->render($template ?: $this->defaultTemplate, ['template' => $template]);
    }

    //        JAFETH
    public function renderModalFooter(string $template = null) // Button $button,
    {
        return $this->gridRenderer->renderModalFooter($template); // $button,
    }

    //        JAFETH
    public function renderButton(Button $button, string $template = null)
    {
        return $this->gridRenderer->renderButton($button, $template);
    }

    /**
     * @param TreeOneToManyView $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function renderOneToMany(TreeOneToManyView $gridView, string $template = null)
    {
        //JAFETH
        return $this->gridRenderer->render($gridView, $template);
    }

    /**
     * @param TreeOneToManyView $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(TreeOneToManyView $gridView, Field $field, $data)
    {
        return $this->gridRenderer->renderField($gridView, $field, $data);
    }

    /**
     * @param TreeOneToManyView $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(TreeOneToManyView $gridView, Action $action, $data = null)
    {
        return $this->gridRenderer->renderAction($gridView, $action, $data);
    }

    /**
     * @param TreeOneToManyView $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(TreeOneToManyView $gridView, Filter $filter)
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
