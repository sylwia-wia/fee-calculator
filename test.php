<?php

require_once 'vendor/autoload.php';

use PragmaGoTech\Interview\Data\BreakpointData;
use PragmaGoTech\Interview\Interface\FeeCalculatorAlgorithm;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\CalculateFee;
use PragmaGoTech\Interview\Service\FeeCalculator;
use PragmaGoTech\Interview\Service\FeeCalculatorLinearAlgorithm;

class FeeCalculatorFactory
{
    public function create(FeeCalculatorAlgorithm $algorithm): FeeCalculator
    {
        return new FeeCalculator($algorithm);
    }

    public function createUsingLinearAlgorithm(): FeeCalculator
    {
        return $this->create(new FeeCalculatorLinearAlgorithm());
    }
}

class Controller
{
    public function __construct(
        private FeeCalculatorFactory $factory,
    )
    {
    }

    public function index(): void
    {
        $service = $this->factory->createUsingLinearAlgorithm();
        $fee = $service->calculate(new BreakpointData(), new LoanProposal(5998));
        echo $fee . PHP_EOL;

    }
}



(new Controller(new FeeCalculatorFactory()))->index();




$algorithm = new FeeCalculatorLinearAlgorithm();
$calculator = new FeeCalculator($algorithm);
$fee = $calculator->calculate(new BreakpointData(), new LoanProposal(5998));
echo $fee;

//$calculateFee = new CalculateFee();
//var_dump($calculateFee->calculateFee(new LoanProposal(1000), 312));

//$control = new Controller(new FeeCalculatorFactory());
//var_dump($control->test());


