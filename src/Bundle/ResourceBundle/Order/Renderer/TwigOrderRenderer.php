<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Order\Renderer;

use Bundle\CoreBundle\Services\Button;
use Bundle\ResourceBundle\Order\Parser\OptionsParserInterface;
//use Component\Order\Definition\Action;
//use Component\Order\Definition\Field;
//use Component\Order\Definition\Filter;
use Component\Order\Renderer\OrderRendererInterface;
//use Component\Order\View\OneToManyViewInterface;

final class TwigOrderRenderer implements OrderRendererInterface
{
    /**
     * @var OneToManyRendererInterface
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
     * @param OneToManyRendererInterface $gridRenderer
     * @param \Twig_Environment $twig
     * @param OptionsParserInterface $optionsParser
     * @param array $actionTemplates
     */
    public function __construct(
        OrderRendererInterface $gridRenderer,
        \Twig_Environment $twig,
        OptionsParserInterface $optionsParser,
        array $actionTemplates = []
    ) {
        $this->gridRenderer = $gridRenderer;
        $this->twig = $twig;
        $this->optionsParser = $optionsParser;
        $this->actionTemplates = $actionTemplates;
    }

    //    JAFETH
    public function orderQuantity(array $orders = [], $id) // Button $button,
    {

//        echo "POLLO:: <pre>";
//        print_r($oneToManyLeft);
//        exit;

//        return $this->twig->render($template ?: $this->defaultTemplate, ['template' => $template]);
    }

    /*
    public function renderModalFooter(?string $action = null)
    {
        switch ($action){
            case Action::EDIT:
            case Action::CREATE:
            case Action::CREATE_CHILD:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_1.html.twig';
//                return self::CLOSED_LEFT . self::SAVE;
                break;
            case Action::CHANGE_PASSWORD:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_2.html.twig';
//                return self::CLOSED_LEFT . self::CHANGE_PASSWORD;
                break;
            case Action::DELETE:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_3.html.twig';
//                return self::CLOSED_LEFT . self::DELETE;
                break;
            case Action::VIEW:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_4.html.twig';
//                return self::CLOSED_RIGHT_DEFAULT;
                break;
            case Action::INFO:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_5.html.twig';
//                return self::CLOSED_RIGHT_OUTLINE;
                break;
            default:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_0.html.twig';
        }

        return (string) $this->twig->render($template, [
            'action' => $action,
        ]);
    }

    public function renderButton(Button $button, ?string $template = null)
    {
        //JAFETH
        return (string) $this->twig->render($template, [
            'button' => $button,
        ]);
    }
    //JAFETH



    public function render(OneToManyViewInterface $gridView, ?string $template = null): string
    {
        return (string) $this->gridRenderer->render($gridView, $template);
    }

    public function renderField(OneToManyViewInterface $gridView, Field $field, $data): string
    {
        return (string) $this->gridRenderer->renderField($gridView, $field, $data);
    }

    public function renderAction(OneToManyViewInterface $gridView, Action $action, $data = null): string
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

    public function renderFilter(OneToManyViewInterface $gridView, Filter $filter): string
    {
        return (string) $this->gridRenderer->renderFilter($gridView, $filter);
    }

    */

}
