<?php

namespace PragmaGoTech\Interview\Tests;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\FeeCalculatorException;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculator;
use PragmaGoTech\Interview\Tests\Data\BreakpointTestData;
use PragmaGoTech\Interview\Tests\Stub\FeeCalculatorStubAlgorithm;

final class FeeCalculatorTest extends TestCase
{
    public function testToSmallLoanValue(): void
    {
        $calculator = new FeeCalculator(new FeeCalculatorStubAlgorithm());

        $this->expectException(FeeCalculatorException::class);
        $calculator->calculate(new BreakpointTestData(), new LoanProposal(999));
    }

    public function testToBigLoanValue(): void
    {
        $calculator = new FeeCalculator(new FeeCalculatorStubAlgorithm());

        $this->expectException(FeeCalculatorException::class);
        $calculator->calculate(new BreakpointTestData(), new LoanProposal(20001));
    }

    public function testInRangeLoadValue(): void
    {
        $calculator = new FeeCalculator(new FeeCalculatorStubAlgorithm());

        $fee = $calculator->calculate(new BreakpointTestData(), new LoanProposal(10000));
        $this->assertEquals(100, $fee, "Fee should have value of 100");
    }
}