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

namespace spec\Component\TreeOneToMany\Provider;

use PhpSpec\ObjectBehavior;
use Component\TreeOneToMany\Definition\ArrayToDefinitionConverterInterface;
use Component\TreeOneToMany\Definition\TreeOneToMany;
use Component\TreeOneToMany\Exception\UndefinedTreeOneToManyException;
use Component\TreeOneToMany\Provider\TreeOneToManyProviderInterface;

final class ArrayTreeOneToManyProviderSpec extends ObjectBehavior
{
    function let(ArrayToDefinitionConverterInterface $converter, TreeOneToMany $firstTreeOneToMany, TreeOneToMany $secondTreeOneToMany, TreeOneToMany $thirdTreeOneToMany, TreeOneToMany $fourthTreeOneToMany): void
    {
        $converter->convert('sylius_admin_tax_category', ['configuration1'])->willReturn($firstTreeOneToMany);
        $converter->convert('sylius_admin_product', ['configuration2' => 'foo'])->willReturn($secondTreeOneToMany);
        $converter->convert('sylius_admin_order', ['configuration3'])->willReturn($thirdTreeOneToMany);
        $converter->convert('sylius_admin_product_from_taxon', ['configuration4' => 'bar', 'configuration2' => 'foo'])->willReturn($fourthTreeOneToMany);

        $this->beConstructedWith($converter, [
            'sylius_admin_tax_category' => ['configuration1'],
            'sylius_admin_product' => ['configuration2' => 'foo'],
            'sylius_admin_order' => ['configuration3'],
            'sylius_admin_product_from_taxon' => ['extends' => 'sylius_admin_product', 'configuration4' => 'bar'],
        ]);
    }

    function it_implements_grid_provider_interface(): void
    {
        $this->shouldImplement(TreeOneToManyProviderInterface::class);
    }

    function it_returns_cloned_grid_definition_by_name(TreeOneToMany $firstTreeOneToMany, TreeOneToMany $secondTreeOneToMany, TreeOneToMany $thirdTreeOneToMany): void
    {
        $this->get('sylius_admin_tax_category')->shouldBeLike($firstTreeOneToMany);
        $this->get('sylius_admin_product')->shouldBeLike($secondTreeOneToMany);
        $this->get('sylius_admin_order')->shouldBeLike($thirdTreeOneToMany);
    }

    function it_supports_grid_inheritance(TreeOneToMany $fourthTreeOneToMany): void
    {
        $this->get('sylius_admin_product_from_taxon')->shouldBeLike($fourthTreeOneToMany);
    }

    function it_throws_an_exception_if_grid_does_not_exist(): void
    {
        $this
            ->shouldThrow(new UndefinedTreeOneToManyException('sylius_admin_order_item'))
            ->during('get', ['sylius_admin_order_item'])
        ;
    }
}
