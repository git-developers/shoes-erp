<?php

declare(strict_types=1);

namespace spec\Component\Taxation\Calculator;

use PhpSpec\ObjectBehavior;
use Component\Registry\ServiceRegistryInterface;
use Component\Taxation\Calculator\CalculatorInterface;
use Component\Taxation\Model\TaxRateInterface;

final class DelegatingCalculatorSpec extends ObjectBehavior
{
    function let(ServiceRegistryInterface $calculators, CalculatorInterface $calculator): void
    {
        $calculators->get('default')->willReturn($calculator);

        $this->beConstructedWith($calculators);
    }

    function it_is_a_calculator(): void
    {
        $this->shouldImplement(CalculatorInterface::class);
    }

    function it_should_delegate_calculation_to_a_correct_calculator(
        CalculatorInterface $calculator,
        TaxRateInterface $rate
    ): void {
        $rate->getCalculator()->willReturn('default');

        $calculator->calculate(100, $rate)->shouldBeCalled()->willReturn(23.00);

        $this->calculate(100, $rate)->shouldReturn(23.00);
    }
}
