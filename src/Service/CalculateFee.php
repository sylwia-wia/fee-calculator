<?php

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Model\LoanProposal;

class CalculateFee
{
    public function calculateFee(LoanProposal $loanProposal, float $rawFee): float
    {
        $all = $rawFee + $loanProposal->amount();
        $all = ceil($all / 5) * 5;
        return $all - $loanProposal->amount();
    }
}