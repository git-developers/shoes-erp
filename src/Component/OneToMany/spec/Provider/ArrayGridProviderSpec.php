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

namespace spec\Component\OneToMany\Provider;

use PhpSpec\ObjectBehavior;
use Component\OneToMany\Definition\ArrayToDefinitionConverterInterface;
use Component\OneToMany\Definition\OneToMany;
use Component\OneToMany\Exception\UndefinedOneToManyException;
use Component\OneToMany\Provider\OneToManyProviderInterface;

final class ArrayOneToManyProviderSpec extends ObjectBehavior
{
    function let(ArrayToDefinitionConverterInterface $converter, OneToMany $firstOneToMany, OneToMany $secondOneToMany, OneToMany $thirdOneToMany, OneToMany $fourthOneToMany): void
    {
        $converter->convert('sylius_admin_tax_category', ['configuration1'])->willReturn($firstOneToMany);
        $converter->convert('sylius_admin_product', ['configuration2' => 'foo'])->willReturn($secondOneToMany);
        $converter->convert('sylius_admin_order', ['configuration3'])->willReturn($thirdOneToMany);
        $converter->convert('sylius_admin_product_from_taxon', ['configuration4' => 'bar', 'configuration2' => 'foo'])->willReturn($fourthOneToMany);

        $this->beConstructedWith($converter, [
            'sylius_admin_tax_category' => ['configuration1'],
            'sylius_admin_product' => ['configuration2' => 'foo'],
            'sylius_admin_order' => ['configuration3'],
            'sylius_admin_product_from_taxon' => ['extends' => 'sylius_admin_product', 'configuration4' => 'bar'],
        ]);
    }

    function it_implements_grid_provider_interface(): void
    {
        $this->shouldImplement(OneToManyProviderInterface::class);
    }

    function it_returns_cloned_grid_definition_by_name(OneToMany $firstOneToMany, OneToMany $secondOneToMany, OneToMany $thirdOneToMany): void
    {
        $this->get('sylius_admin_tax_category')->shouldBeLike($firstOneToMany);
        $this->get('sylius_admin_product')->shouldBeLike($secondOneToMany);
        $this->get('sylius_admin_order')->shouldBeLike($thirdOneToMany);
    }

    function it_supports_grid_inheritance(OneToMany $fourthOneToMany): void
    {
        $this->get('sylius_admin_product_from_taxon')->shouldBeLike($fourthOneToMany);
    }

    function it_throws_an_exception_if_grid_does_not_exist(): void
    {
        $this
            ->shouldThrow(new UndefinedOneToManyException('sylius_admin_order_item'))
            ->during('get', ['sylius_admin_order_item'])
        ;
    }
}
