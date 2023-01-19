<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Data\BreakpointDataBase;
use PragmaGoTech\Interview\Exception\FeeCalculatorLinearAlgorithmException;
use PragmaGoTech\Interview\Interface\FeeCalculatorAlgorithm;
use PragmaGoTech\Interview\Model\LoanProposal;


class FeeCalculatorLinearAlgorithm implements FeeCalculatorAlgorithm
{
    /**
     * @throws FeeCalculatorLinearAlgorithmException
     */
    public function calculate(BreakpointDataBase $breakpointData, LoanProposal $loanProposal): float
    {
        $dataTable = $breakpointData->getData();

        if ($loanProposal->amount() < $breakpointData->getMinLoanValue()
            || $loanProposal->amount() > $breakpointData->getMaxLoanValue()) {
            throw new FeeCalculatorLinearAlgorithmException("The loan amount is out of range.");
        }

        if (isset($dataTable[$loanProposal->amount()])) {
            $fee = $dataTable[$loanProposal->amount()];
            return $this->calculateFee($loanProposal, $fee);
        }

        ksort($dataTable);
        $minKey = null;
        $maxKey = null;
        $minFee = null;
        $maxFee = null;

        foreach ($dataTable as $key => $value) {
            if ($key < $loanProposal->amount()) {
                $minKey = $key;
                $minFee = $value;
                continue;
            }

            $maxKey = $key;
            $maxFee = $value;
            break;
        }

        $d = ($loanProposal->amount() - $minKey) / ($maxKey - $minKey);
        $fee = $minFee * (1-$d) + $maxFee * $d;

        return $this->calculateFee($loanProposal, $fee);
    }

    private function calculateFee(LoanProposal $loanProposal, float $rawFee): float
    {
        $all = $rawFee + $loanProposal->amount();
        $all = ceil($all / 5) * 5;
        return $all - $loanProposal->amount();
    }
}