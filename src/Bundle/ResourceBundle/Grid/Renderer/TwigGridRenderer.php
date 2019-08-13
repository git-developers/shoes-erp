<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Grid\Renderer;

use Bundle\CoreBundle\Services\Button;
use Bundle\ResourceBundle\Grid\Parser\OptionsParserInterface;
use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\Grid\Renderer\GridRendererInterface;
use Component\Grid\View\GridViewInterface;
use Bundle\GridBundle\Services\Grid\Builder\DataTableMapper;

final class TwigGridRenderer implements GridRendererInterface
{
    /**
     * @var GridRendererInterface
     */
    private $gridRenderer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var OptionsParserInterface
     */
    private $optionsParser;

    /**
     * @var array
     */
    private $actionTemplates;

    /**
     * @param GridRendererInterface $gridRenderer
     * @param \Twig_Environment $twig
     * @param OptionsParserInterface $optionsParser
     * @param array $actionTemplates
     */
    public function __construct(
        GridRendererInterface $gridRenderer,
        \Twig_Environment $twig,
        OptionsParserInterface $optionsParser,
        array $actionTemplates = []
    ) {
        $this->gridRenderer = $gridRenderer;
        $this->twig = $twig;
        $this->optionsParser = $optionsParser;
        $this->actionTemplates = $actionTemplates;
    }

    //        JAFETH
    public function renderFormJs($vars, $modal, $formMapper, DataTableMapper $dataTable, string $template = null)
    {

        return (string) $this->twig->render($template, [
            'vars' => $vars,
            'modal' => $modal,
            'form_mapper' => $formMapper,
            'dataTable' => $dataTable,
        ]);
    }


    //JAFETH
    public function renderModalFooter(string $action = null)
    {
    	
        switch ($action){
            case Action::EDIT:
            case Action::CREATE:
            case Action::CREATE_CHILD:
                $template = '@Ui/Grid/Button/Footer/_modal_button_1.html.twig';
                break;
            case Action::CHANGE_PASSWORD:
                $template = '@Ui/Grid/Button/Footer/_modal_button_2.html.twig';
                break;
            case Action::DELETE:
                $template = '@Ui/Grid/Button/Footer/_modal_button_3.html.twig';
                break;
            case Action::VIEW:
            case Action::PAYMENT_HISTORY:
                $template = '@Ui/Grid/Button/Footer/_modal_button_4.html.twig';
                break;
            case Action::INFO:
                $template = '@Ui/Grid/Button/Footer/_modal_button_5.html.twig';
                break;
            case Action::UPLOAD_FILE:
                $template = '@Ui/Grid/Button/Footer/_modal_button_6.html.twig';
                break;
            default:
                $template = '@Ui/Grid/Button/Footer/_modal_button_0.html.twig';
        }

        return (string) $this->twig->render($template, [
            'action' => $action,
        ]);
    }

    public function renderButton(Button $button, string $template = null)
    {
        //JAFETH
        return (string) $this->twig->render($template, [
            'button' => $button,
        ]);
    }
    //JAFETH




    /**
     * {@inheritdoc}
     */
    public function render(GridViewInterface $gridView, string $template = null)
    {
        return (string) $this->gridRenderer->render($gridView, $template);
    }

    /**
     * {@inheritdoc}
     */
    public function renderField(GridViewInterface $gridView, Field $field, $data)
    {
        return (string) $this->gridRenderer->renderField($gridView, $field, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function renderAction(GridViewInterface $gridView, Action $action, $data = null)
    {
        $type = $action->getType();
        if (!isset($this->actionTemplates[$type])) {
            throw new \InvalidArgumentException(sprintf('Missing template for action type "%s".', $type));
        }

        $options = $this->optionsParser->parseOptions(
            $action->getOptions(),
            $gridView->getRequestConfiguration()->getRequest(),
            $data
        );

        return (string) $this->twig->render($this->actionTemplates[$type], [
            'grid' => $gridView,
            'action' => $action,
            'data' => $data,
            'options' => $options,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function renderFilter(GridViewInterface $gridView, Filter $filter)
    {
        return (string) $this->gridRenderer->renderFilter($gridView, $filter);
    }
}
