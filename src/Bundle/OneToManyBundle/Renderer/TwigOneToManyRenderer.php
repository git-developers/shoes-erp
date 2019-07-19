<?php

declare(strict_types=1);

namespace Bundle\OneToManyBundle\Renderer;

use Bundle\OneToManyBundle\Form\Registry\FormTypeRegistryInterface;
use Bundle\CoreBundle\Services\Button;
use Component\OneToMany\Definition\Action;
use Component\OneToMany\Definition\Field;
use Component\OneToMany\Definition\Filter;
use Component\OneToMany\FieldTypes\FieldTypeInterface;
use Component\OneToMany\Renderer\OneToManyRendererInterface;
use Component\OneToMany\View\OneToManyViewInterface;
use Component\Registry\ServiceRegistryInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TwigOneToManyRenderer implements OneToManyRendererInterface
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
    public function boxRightIsAssigned(array $oneToManyLeft = [], $id) // Button $button,
    {

//        echo "POLLO: 222: <pre>";
//        print_r($oneToManyLeft);
//        exit;

//        return $this->twig->render($template ?: $this->defaultTemplate, ['template' => $template]);
    }

    //    JAFETH
    public function renderModalFooter(string $template = null) // Button $button,
    {
        return $this->twig->render($template ?: $this->defaultTemplate, ['template' => $template]);
    }

    //    JAFETH
    public function renderButton(Button $button, string $template = null)
    {
        return $this->twig->render($template ?: $this->defaultTemplate, ['grid' => $button]);
    }

    /**
     * {@inheritdoc}
     */
    public function render(OneToManyViewInterface $gridView, string $template = null)
    {

//        $template ---- @SyliusUi/OneToMany/_default.html.twig
//        $this->defaultTemplate ---- SyliusOneToManyBundle::_grid.html.twig
//        $this->defaultTemplate ---- SyliusOneToManyBundle::_grid.html.twig


//        echo '<pre> POLLO:: ';
//        print_r($gridView);
//        exit;



        return $this->twig->render($template ?: $this->defaultTemplate, ['grid' => $gridView]);
    }

    /**
     * {@inheritdoc}
     */
    public function renderField(OneToManyViewInterface $gridView, Field $field, $data)
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
    public function renderAction(OneToManyViewInterface $gridView, Action $action, $data = null)
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
    public function renderFilter(OneToManyViewInterface $gridView, Filter $filter)
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
}
