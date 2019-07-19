<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Google\Renderer;

use Bundle\CoreBundle\Services\Button;
use Bundle\ResourceBundle\Google\Parser\OptionsParserInterface;
use Component\Google\Definition\Action;
use Component\Google\Definition\Field;
use Component\Google\Definition\Filter;
use Component\Google\Renderer\GoogleRendererInterface;
use Component\Google\View\GoogleViewInterface;

final class TwigGoogleRenderer implements GoogleRendererInterface
{
    /**
     * @var GoogleRendererInterface
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
     * @param GoogleRendererInterface $gridRenderer
     * @param \Twig_Environment $twig
     * @param OptionsParserInterface $optionsParser
     * @param array $actionTemplates
     */
    public function __construct(
        GoogleRendererInterface $gridRenderer,
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
    public function googleSpanClass($mimeType)
    {
;
//        return $this->twig->render($template ?: $this->defaultTemplate, ['template' => $template]);
    }

    /**
     * {@inheritdoc}
     */
    public function render(GoogleViewInterface $gridView, string $template = null)
    {
        return (string) $this->gridRenderer->render($gridView, $template);
    }

    /**
     * {@inheritdoc}
     */
    public function renderField(GoogleViewInterface $gridView, Field $field, $data)
    {
        return (string) $this->gridRenderer->renderField($gridView, $field, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function renderAction(GoogleViewInterface $gridView, Action $action, $data = null)
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
    public function renderFilter(GoogleViewInterface $gridView, Filter $filter)
    {
        return (string) $this->gridRenderer->renderFilter($gridView, $filter);
    }

    public function renderViewer(string $fileId = null, string $template = null)
    {
        return $this->twig->render($template, [
            'fileId' => $fileId,
        ]);
    }
}
