<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Data\BreakpointDataBase;
use PragmaGoTech\Interview\Exception\FeeCalculatorException;
use PragmaGoTech\Interview\Interface\FeeCalculatorAlgorithm;
use PragmaGoTech\Interview\Model\LoanProposal;


class FeeCalculator implements \PragmaGoTech\Interview\Interface\FeeCalculator
{
    private const MIN_AMOUNT = 1000;
    private const MAX_AMOUNT = 20000;

    private FeeCalculatorAlgorithm $feeCalculatorAlgorithm;


    public function __construct(FeeCalculatorAlgorithm $feeCalculatorAlgorithm)
    {
        $this->feeCalculatorAlgorithm = $feeCalculatorAlgorithm;
    }


    public function calculate(BreakpointDataBase $breakpointData, LoanProposal $loanProposal): float
    {
        if ($loanProposal->amount() < self::MIN_AMOUNT || $loanProposal->amount() > self::MAX_AMOUNT) {
            throw new FeeCalculatorException(sprintf("Incorrect amount. The allowed range is %.2f to %.2f", self::MIN_AMOUNT, self::MAX_AMOUNT));
        }

        return $this->feeCalculatorAlgorithm->calculate($breakpointData, $loanProposal);
    }
}