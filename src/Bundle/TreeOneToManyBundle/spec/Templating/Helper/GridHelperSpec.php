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

namespace spec\Bundle\TreeOneToManyBundle\Templating\Helper;

use PhpSpec\ObjectBehavior;
use Component\OneToMany\Definition\Action;
use Component\OneToMany\Definition\Field;
use Component\OneToMany\Renderer\OneToManyRendererInterface;
use Component\OneToMany\View\OneToManyView;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\Helper\HelperInterface;

final class OneToManyHelperSpec extends ObjectBehavior
{
    function let(OneToManyRendererInterface $gridRenderer): void
    {
        $this->beConstructedWith($gridRenderer);
    }

    function it_is_a_templating_helper(): void
    {
        $this->shouldImplement(HelperInterface::class);
    }

    function it_extends_base_templating_helper(): void
    {
        $this->shouldHaveType(Helper::class);
    }

    function it_uses_grid_renderer_to_render_grid(OneToManyRendererInterface $gridRenderer, OneToManyView $gridView): void
    {
        $gridRenderer->render($gridView, null)->willReturn('<html>OneToMany!</html>');
        $this->renderOneToMany($gridView, null)->shouldReturn('<html>OneToMany!</html>');
    }

    function it_uses_grid_renderer_to_render_field(OneToManyRendererInterface $gridRenderer, OneToManyView $gridView, Field $field): void
    {
        $gridRenderer->renderField($gridView, $field, 'foo')->willReturn('Value');
        $this->renderField($gridView, $field, 'foo')->shouldReturn('Value');
    }

    function it_uses_grid_renderer_to_render_action(OneToManyRendererInterface $gridRenderer, OneToManyView $gridView, Action $action): void
    {
        $gridRenderer->renderAction($gridView, $action, null)->willReturn('<a href="#">Go go Gadget arms!</a>');
        $this->renderAction($gridView, $action)->shouldReturn('<a href="#">Go go Gadget arms!</a>');
    }

    function it_has_name(): void
    {
        $this->getName()->shouldReturn('sylius_grid');
    }
}
