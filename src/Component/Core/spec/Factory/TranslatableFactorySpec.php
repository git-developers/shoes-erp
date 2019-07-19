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

namespace spec\Component\Resource\Factory;

use PhpSpec\ObjectBehavior;
use Component\Resource\Exception\UnexpectedTypeException;
use Component\Resource\Factory\FactoryInterface;
use Component\Resource\Factory\TranslatableFactoryInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;

final class TranslatableFactorySpec extends ObjectBehavior
{
    function let(FactoryInterface $factory, TranslationLocaleProviderInterface $localeProvider): void
    {
        $this->beConstructedWith($factory, $localeProvider);
    }

    function it_implements_translatable_factory_interface(): void
    {
        $this->shouldImplement(TranslatableFactoryInterface::class);
    }

    function it_throws_an_exception_if_resource_is_not_translatable(FactoryInterface $factory, \stdClass $resource): void
    {
        $factory->createNew()->willReturn($resource);

        $this
            ->shouldThrow(UnexpectedTypeException::class)
            ->during('createNew')
        ;
    }

    function it_creates_translatable_and_sets_locales(
        FactoryInterface $factory,
        TranslationLocaleProviderInterface $localeProvider,
        TranslatableInterface $resource
    ): void {
        $localeProvider->getDefaultLocaleCode()->willReturn('pl_PL');

        $factory->createNew()->willReturn($resource);

        $resource->setCurrentLocale('pl_PL')->shouldBeCalled();
        $resource->setFallbackLocale('pl_PL')->shouldBeCalled();

        $this->createNew()->shouldReturn($resource);
    }
}
