<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interface;

use PragmaGoTech\Interview\Data\BreakpointDataBase;
use PragmaGoTech\Interview\Model\LoanProposal;

interface FeeCalculator
{
    public function calculate(BreakpointDataBase $breakpointData, LoanProposal $loanProposal): float;
}
