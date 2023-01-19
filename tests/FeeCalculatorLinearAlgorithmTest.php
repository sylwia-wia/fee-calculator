<?php

namespace PragmaGoTech\Interview\Tests;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\FeeCalculatorLinearAlgorithmException;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculatorLinearAlgorithm;
use PragmaGoTech\Interview\Tests\Data\BreakpointTestData;

class FeeCalculatorLinearAlgorithmTest extends TestCase
{
    public function testLinearAlgorithmFor1000LoanValue():void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();
        $fee = $algorithm->calculate(new BreakpointTestData(), new LoanProposal(1000));
        $this->assertEquals(50, $fee);
    }

    public function testLinearAlgorithmFor6500LoanValue():void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();
        $fee = $algorithm->calculate(new BreakpointTestData(), new LoanProposal(6500));
        $this->assertEquals(130, $fee);
    }

    /**
     * @throws FeeCalculatorLinearAlgorithmException
     */
    public function testLinearAlgorithmFor1234LoanValue():void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();

        $fee = $algorithm->calculate(new BreakpointTestData(), new LoanProposal(1234));

        $this->assertNotEquals(60, $fee);
    }

    /**
     * @throws FeeCalculatorLinearAlgorithmException
     */
    public function testLinearAlgorithmFor1001LoanValue():void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();

        $fee = $algorithm->calculate(new BreakpointTestData(), new LoanProposal(1001));

        $this->assertEquals(54, $fee);
    }

    /**
     * @throws FeeCalculatorLinearAlgorithmException
     */
    public function testLinearAlgorithmFor8999LoanValue():void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();

        $fee = $algorithm->calculate(new BreakpointTestData(), new LoanProposal(8999));

        $this->assertEquals(181, $fee, "Fee should have value of 181");
    }

    public function testLinearAlgorithmToSmallLoanValue():void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();

        $this->expectException(FeeCalculatorLinearAlgorithmException::class);
        $algorithm->calculate(new BreakpointTestData(), new LoanProposal(856));
    }

    public function testLinearAlgorithmToBigLoanValue():void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();

        $this->expectException(FeeCalculatorLinearAlgorithmException::class);
        $algorithm->calculate(new BreakpointTestData(), new LoanProposal(20001));
    }
}