<?php

namespace PragmaGoTech\Interview\Tests\Stub;

use PragmaGoTech\Interview\Data\BreakpointDataBase;
use PragmaGoTech\Interview\Interface\FeeCalculatorAlgorithm;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculatorStubAlgorithm implements FeeCalculatorAlgorithm
{
    public function calculate(BreakpointDataBase $breakPointsData, LoanProposal $loanProposal): float
    {
        return 100;
    }
}