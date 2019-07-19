<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\Bundle\OneToManyBundle\Renderer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Bundle\OneToManyBundle\Form\Registry\FormTypeRegistryInterface;
use Component\OneToMany\Definition\Action;
use Component\OneToMany\Definition\Field;
use Component\OneToMany\FieldTypes\FieldTypeInterface;
use Component\OneToMany\Filter\StringFilter;
use Component\OneToMany\Renderer\OneToManyRendererInterface;
use Component\OneToMany\View\OneToManyView;
use Component\OneToMany\View\OneToManyViewInterface;
use Component\Registry\ServiceRegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TwigOneToManyRendererSpec extends ObjectBehavior
{
    function let(
        \Twig_Environment $twig,
        ServiceRegistryInterface $fieldsRegistry,
        FormFactoryInterface $formFactory,
        FormTypeRegistryInterface $formTypeRegistry
    ): void {
        $actionTemplates = [
            'link' => 'SyliusOneToManyBundle:Action:_link.html.twig',
            'form' => 'SyliusOneToManyBundle:Action:_form.html.twig',
        ];
        $filterTemplates = [
            StringFilter::NAME => 'SyliusOneToManyBundle:Filter:_string.html.twig',
        ];

        $this->beConstructedWith(
            $twig,
            $fieldsRegistry,
            $formFactory,
            $formTypeRegistry,
            'SyliusOneToManyBundle:default.html.twig',
            $actionTemplates,
            $filterTemplates
        );
    }

    function it_is_a_grid_renderer(): void
    {
        $this->shouldImplement(OneToManyRendererInterface::class);
    }

    function it_uses_twig_to_render_the_grid_view(\Twig_Environment $twig, OneToManyViewInterface $gridView): void
    {
        $twig->render('SyliusOneToManyBundle:default.html.twig', ['grid' => $gridView])->willReturn('<html>OneToMany!</html>');
        $this->render($gridView)->shouldReturn('<html>OneToMany!</html>');
    }

    function it_uses_custom_template_if_specified(\Twig_Environment $twig, OneToManyView $gridView): void
    {
        $twig->render('SyliusOneToManyBundle:custom.html.twig', ['grid' => $gridView])->willReturn('<html>OneToMany!</html>');
        $this->render($gridView, 'SyliusOneToManyBundle:custom.html.twig')->shouldReturn('<html>OneToMany!</html>');
    }

    function it_uses_twig_to_render_the_action(\Twig_Environment $twig, OneToManyViewInterface $gridView, Action $action): void
    {
        $action->getType()->willReturn('link');
        $action->getOptions()->willReturn([]);

        $twig
            ->render('SyliusOneToManyBundle:Action:_link.html.twig', [
                'grid' => $gridView,
                'action' => $action,
                'data' => null,
            ])
            ->willReturn('<a href="#">Action!</a>')
        ;

        $this->renderAction($gridView, $action)->shouldReturn('<a href="#">Action!</a>');
    }

    function it_renders_a_field_with_data_via_appropriate_field_type(
        OneToManyViewInterface $gridView,
        Field $field,
        ServiceRegistryInterface $fieldsRegistry,
        FieldTypeInterface $fieldType
    ): void {
        $field->getType()->willReturn('string');
        $fieldsRegistry->get('string')->willReturn($fieldType);
        $fieldType->configureOptions(Argument::type(OptionsResolver::class))
            ->will(function ($args) {
                $args[0]->setRequired('foo');
            })
        ;

        $field->getOptions()->willReturn([
            'foo' => 'bar',
        ]);
        $fieldType->render($field, 'Value', ['foo' => 'bar'])->willReturn('<strong>Value</strong>');

        $this->renderField($gridView, $field, 'Value')->shouldReturn('<strong>Value</strong>');
    }

    function it_throws_an_exception_if_template_is_not_configured_for_given_action_type(
        OneToManyViewInterface $gridView,
        Action $action
    ): void {
        $action->getType()->willReturn('foo');

        $this
            ->shouldThrow(new \InvalidArgumentException('Missing template for action type "foo".'))
            ->during('renderAction', [$gridView, $action])
        ;
    }
}
