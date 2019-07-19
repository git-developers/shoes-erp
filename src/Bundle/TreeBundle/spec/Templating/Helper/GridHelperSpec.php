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

namespace spec\Bundle\TreeBundle\Templating\Helper;

use PhpSpec\ObjectBehavior;
use Component\Tree\Definition\Action;
use Component\Tree\Definition\Field;
use Component\Tree\Renderer\TreeRendererInterface;
use Component\Tree\View\TreeView;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\Helper\HelperInterface;

final class TreeHelperSpec extends ObjectBehavior
{
    function let(TreeRendererInterface $gridRenderer): void
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

    function it_uses_grid_renderer_to_render_grid(TreeRendererInterface $gridRenderer, TreeView $gridView): void
    {
        $gridRenderer->render($gridView, null)->willReturn('<html>Tree!</html>');
        $this->renderTree($gridView, null)->shouldReturn('<html>Tree!</html>');
    }

    function it_uses_grid_renderer_to_render_field(TreeRendererInterface $gridRenderer, TreeView $gridView, Field $field): void
    {
        $gridRenderer->renderField($gridView, $field, 'foo')->willReturn('Value');
        $this->renderField($gridView, $field, 'foo')->shouldReturn('Value');
    }

    function it_uses_grid_renderer_to_render_action(TreeRendererInterface $gridRenderer, TreeView $gridView, Action $action): void
    {
        $gridRenderer->renderAction($gridView, $action, null)->willReturn('<a href="#">Go go Gadget arms!</a>');
        $this->renderAction($gridView, $action)->shouldReturn('<a href="#">Go go Gadget arms!</a>');
    }

    function it_has_name(): void
    {
        $this->getName()->shouldReturn('sylius_grid');
    }
}
