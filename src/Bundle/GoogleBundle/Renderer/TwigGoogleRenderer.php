<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Renderer;

use Bundle\GoogleBundle\Form\Registry\FormTypeRegistryInterface;
use Bundle\CoreBundle\Services\Button;
use Component\Google\Definition\Action;
use Component\Google\Definition\Field;
use Component\Google\Definition\Filter;
use Component\Google\FieldTypes\FieldTypeInterface;
use Component\Google\Renderer\GoogleRendererInterface;
use Component\Google\View\GoogleViewInterface;
use Component\Registry\ServiceRegistryInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TwigGoogleRenderer implements GoogleRendererInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var ServiceRegistryInterface
     */
    private $fieldsRegistry;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var FormTypeRegistryInterface
     */
    private $formTypeRegistry;

    /**
     * @var string
     */
    private $defaultTemplate;

    /**
     * @var array
     */
    private $actionTemplates;

    /**
     * @var array
     */
    private $filterTemplates;

    /**
     * @param \Twig_Environment $twig
     * @param ServiceRegistryInterface $fieldsRegistry
     * @param FormFactoryInterface $formFactory
     * @param FormTypeRegistryInterface $formTypeRegistry
     * @param string $defaultTemplate
     * @param array $actionTemplates
     * @param array $filterTemplates
     */
    public function __construct(
        \Twig_Environment $twig,
        ServiceRegistryInterface $fieldsRegistry,
        FormFactoryInterface $formFactory,
        FormTypeRegistryInterface $formTypeRegistry,
        string $defaultTemplate,
        array $actionTemplates = [],
        array $filterTemplates = []
    ) {
        $this->twig = $twig;
        $this->fieldsRegistry = $fieldsRegistry;
        $this->formFactory = $formFactory;
        $this->formTypeRegistry = $formTypeRegistry;
        $this->defaultTemplate = $defaultTemplate;
        $this->actionTemplates = $actionTemplates;
        $this->filterTemplates = $filterTemplates;
    }

    //    JAFETH
    public function googleSpanClass($mimeType)
    {


//        return $this->twig->render($template ?: $this->defaultTemplate, ['template' => $template]);
    }

    /**
     * {@inheritdoc}
     */
    public function renderField(GoogleViewInterface $gridView, Field $field, $data)
    {
        /** @var FieldTypeInterface $fieldType */
        $fieldType = $this->fieldsRegistry->get($field->getType());
        $resolver = new OptionsResolver();
        $fieldType->configureOptions($resolver);
        $options = $resolver->resolve($field->getOptions());

        return $fieldType->render($field, $data, $options);
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

        return $this->twig->render($this->actionTemplates[$type], [
            'grid' => $gridView,
            'action' => $action,
            'data' => $data,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function renderFilter(GoogleViewInterface $gridView, Filter $filter)
    {
        $template = $this->getFilterTemplate($filter);

        $form = $this->formFactory->createNamed('criteria', FormType::class, [], [
            'allow_extra_fields' => true,
            'csrf_protection' => false,
            'required' => false,
        ]);
        $form->add(
            $filter->getName(),
            $this->formTypeRegistry->get($filter->getType(), 'default'),
            $filter->getFormOptions()
        );

        $criteria = $gridView->getParameters()->get('criteria', []);
        $form->submit($criteria);

        return $this->twig->render($template, [
            'grid' => $gridView,
            'filter' => $filter,
            'form' => $form->get($filter->getName())->createView(),
        ]);
    }

    /**
     * @param Filter $filter
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    private function getFilterTemplate(Filter $filter): string
    {
        $template = $filter->getTemplate();
        if (null !== $template) {
            return $template;
        }

        $type = $filter->getType();
        if (!isset($this->filterTemplates[$type])) {
            throw new \InvalidArgumentException(sprintf('Missing template for filter type "%s".', $type));
        }

        return $this->filterTemplates[$type];
    }

    public function render(GoogleViewInterface $gridView, string $template = null)
    {
        // TODO: Implement render() method.
    }

    public function renderViewer(string $fileId = NULL, string $fileMimeType = null)
    {

    }
}
