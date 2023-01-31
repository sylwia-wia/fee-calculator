<?php

namespace PragmaGoTech\Interview\Tests;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\FeeCalculatorLinearAlgorithmException;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculatorLinearAlgorithm;
use PragmaGoTech\Interview\Tests\Data\BreakpointTestData;

final class FeeCalculatorLinearAlgorithmTest extends TestCase
{
    /**
     * @throws FeeCalculatorLinearAlgorithmException
     * @dataProvider addBadDataProvider
     */
    public function testLinearAlgorithmForBadLoanValue($loan, $expected ):void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();

        $fee = $algorithm->calculate(new BreakpointTestData(), new LoanProposal($loan));

        $this->assertNotEquals($expected, $fee);
    }

    /**
     * @throws FeeCalculatorLinearAlgorithmException
     * @dataProvider addCorrectDataProvider
     */
    public function testLinearAlgorithmForCorrectLoanValue($loan, $expected):void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();

        $fee = $algorithm->calculate(new BreakpointTestData(), new LoanProposal($loan));

        $this->assertEquals($expected, $fee);
    }


    /**
     * @param $loan
     * @return void
     * @throws FeeCalculatorLinearAlgorithmException
     * @dataProvider addDataProviderToSmallLoanValue
     */
    public function testLinearAlgorithmToSmallLoanValue($loan):void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();

        $this->expectException(FeeCalculatorLinearAlgorithmException::class);
        $algorithm->calculate(new BreakpointTestData(), new LoanProposal($loan));
    }

    /**
     * @param $loan
     * @return void
     * @throws FeeCalculatorLinearAlgorithmException
     * @dataProvider addDataProviderToBigLoanValue
     */
    public function testLinearAlgorithmToBigLoanValue($loan):void
    {
        $algorithm = new FeeCalculatorLinearAlgorithm();

        $this->expectException(FeeCalculatorLinearAlgorithmException::class);
        $algorithm->calculate(new BreakpointTestData(), new LoanProposal($loan));
    }

    public function addCorrectDataProvider()
    {
        return [
            [8999, 181],
            [1001, 54],
            [5998, 122],
            [1000, 50],
            [6500, 130],
        ];
    }

    public function addBadDataProvider()
    {
        return [
            [1000, 67],
            [5998, 111],
            [9999, 287],
            [3456, 87],
            [6500, 131],
        ];

    }

    public function addDataProviderToSmallLoanValue()
    {
        return [
            [999],
            [98],
            [899],
            [123],
        ];
    }

    public function addDataProviderToBigLoanValue()
    {
        return [
            [20001],
            [55000],
            [21000],
            [100000],
        ];
    }

}