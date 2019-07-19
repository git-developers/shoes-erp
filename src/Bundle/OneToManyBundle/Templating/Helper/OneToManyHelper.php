<?php

declare(strict_types=1);

namespace Bundle\OneToManyBundle\Templating\Helper;

use Component\OneToMany\Definition\Action;
use Component\OneToMany\Definition\Field;
use Component\OneToMany\Definition\Filter;
use Component\OneToMany\Renderer\OneToManyRendererInterface;
use Component\OneToMany\View\OneToManyView;
use Bundle\CoreBundle\Services\Button;
use Symfony\Component\Templating\Helper\Helper;

class OneToManyHelper extends Helper
{
    /**
     * @var OneToManyRendererInterface
     */
    private $gridRenderer;

    /**
     * @param OneToManyRendererInterface $gridRenderer
     */
    public function __construct(OneToManyRendererInterface $gridRenderer)
    {
        $this->gridRenderer = $gridRenderer;
    }

    //    JAFETH
    public function boxRightIsAssigned(array $oneToManyLeftIds = [], $id)
    {

//        echo "POLLO:: <pre>";
//        print_r($oneToManyLeftIds);
//        exit;




        if(empty($oneToManyLeftIds)){
            return false;
        }

        foreach (array_shift($oneToManyLeftIds) as $key => $value){
            if(array_shift($value) === $id){
                return true;
            }
        }

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
     * @param OneToManyView $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function renderOneToMany(OneToManyView $gridView, string $template = null)
    {
        //JAFETH
        return $this->gridRenderer->render($gridView, $template);
    }

    /**
     * @param OneToManyView $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(OneToManyView $gridView, Field $field, $data)
    {
        return $this->gridRenderer->renderField($gridView, $field, $data);
    }

    /**
     * @param OneToManyView $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(OneToManyView $gridView, Action $action, $data = null)
    {
        return $this->gridRenderer->renderAction($gridView, $action, $data);
    }

    /**
     * @param OneToManyView $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(OneToManyView $gridView, Filter $filter)
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
