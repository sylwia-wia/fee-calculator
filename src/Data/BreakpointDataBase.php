<?php
declare(strict_types=1);

namespace PragmaGoTech\Interview\Data;

abstract class BreakpointDataBase
{
    protected array $data = [];

    public function getData(): array
    {
        return $this->data;
    }

    public function getMaxLoanValue(): float
    {
        return max(array_keys($this->data));
    }

    public function getMinLoanValue(): float
    {
        return min(array_keys($this->data));
    }
}