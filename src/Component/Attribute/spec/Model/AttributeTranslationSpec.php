<?php

declare(strict_types=1);

namespace Component\Attribute\Model;

use PhpSpec\ObjectBehavior;
use Component\Attribute\Model\AttributeTranslation;
use Component\Attribute\Model\AttributeTranslationInterface;

final class AttributeTranslationSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(AttributeTranslation::class);
    }

    function it_implements_attribute_translation_interface(): void
    {
        $this->shouldImplement(AttributeTranslationInterface::class);
    }

    function it_has_no_id_by_default(): void
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_name_by_default(): void
    {
        $this->getName()->shouldReturn(null);
    }

    function its_name_is_mutable(): void
    {
        $this->setName('Size');
        $this->getName()->shouldReturn('Size');
    }
}
