<?php
declare(strict_types=1);

namespace PragmaGoTech\Interview\Interface;

use PragmaGoTech\Interview\Data\BreakpointDataBase;
use PragmaGoTech\Interview\Model\LoanProposal;

interface FeeCalculatorAlgorithm
{
    public function calculate(BreakpointDataBase $breakPointsData, LoanProposal $loanProposal): float;

}