<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Renderer;

use Bundle\UserBundle\Form\Registry\FormTypeRegistryInterface;
use Bundle\CoreBundle\Services\Button;
use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\Grid\FieldTypes\FieldTypeInterface;
use Component\User\Renderer\UserRendererInterface;
use Component\Grid\View\GridViewInterface;
use Component\Registry\ServiceRegistryInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bundle\GridBundle\Services\Grid\Builder\DataTableMapper;
use Bundle\UserBundle\Entity\User;

final class TwigUserRenderer implements UserRendererInterface
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

    //        JAFETH
    public function profileAboutMe(string $aboutMe = null)
    {
        return $this->twig->render($aboutMe ?: $this->defaultTemplate, ['template' => $aboutMe]);
    }

    public function appUserName(User $user, $start, $length = null)
    {
        $name = $user->getName();
        $name = !is_null($name) ? substr($name, $start, $length) : '';

        $lastName = $user->getLastName();
        $lastName = !is_null($lastName) ? substr($lastName, $start, $length) : '';

        return $name .' '. $lastName;
    }
}
