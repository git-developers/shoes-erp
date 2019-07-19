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

namespace spec\Component\Tree\Provider;

use PhpSpec\ObjectBehavior;
use Component\Tree\Definition\ArrayToDefinitionConverterInterface;
use Component\Tree\Definition\Tree;
use Component\Tree\Exception\UndefinedTreeException;
use Component\Tree\Provider\TreeProviderInterface;

final class ArrayTreeProviderSpec extends ObjectBehavior
{
    function let(ArrayToDefinitionConverterInterface $converter, Tree $firstTree, Tree $secondTree, Tree $thirdTree, Tree $fourthTree): void
    {
        $converter->convert('sylius_admin_tax_category', ['configuration1'])->willReturn($firstTree);
        $converter->convert('sylius_admin_product', ['configuration2' => 'foo'])->willReturn($secondTree);
        $converter->convert('sylius_admin_order', ['configuration3'])->willReturn($thirdTree);
        $converter->convert('sylius_admin_product_from_taxon', ['configuration4' => 'bar', 'configuration2' => 'foo'])->willReturn($fourthTree);

        $this->beConstructedWith($converter, [
            'sylius_admin_tax_category' => ['configuration1'],
            'sylius_admin_product' => ['configuration2' => 'foo'],
            'sylius_admin_order' => ['configuration3'],
            'sylius_admin_product_from_taxon' => ['extends' => 'sylius_admin_product', 'configuration4' => 'bar'],
        ]);
    }

    function it_implements_grid_provider_interface(): void
    {
        $this->shouldImplement(TreeProviderInterface::class);
    }

    function it_returns_cloned_grid_definition_by_name(Tree $firstTree, Tree $secondTree, Tree $thirdTree): void
    {
        $this->get('sylius_admin_tax_category')->shouldBeLike($firstTree);
        $this->get('sylius_admin_product')->shouldBeLike($secondTree);
        $this->get('sylius_admin_order')->shouldBeLike($thirdTree);
    }

    function it_supports_grid_inheritance(Tree $fourthTree): void
    {
        $this->get('sylius_admin_product_from_taxon')->shouldBeLike($fourthTree);
    }

    function it_throws_an_exception_if_grid_does_not_exist(): void
    {
        $this
            ->shouldThrow(new UndefinedTreeException('sylius_admin_order_item'))
            ->during('get', ['sylius_admin_order_item'])
        ;
    }
}
