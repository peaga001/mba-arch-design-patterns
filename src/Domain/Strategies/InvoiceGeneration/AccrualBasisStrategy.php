<?php

namespace App\Domain\Strategies\InvoiceGeneration;

use App\Domain\Entities\Contract;
use App\Domain\Entities\Invoice;
use App\Domain\Interfaces\InvoiceGenerationStrategy;

class AccrualBasisStrategy implements InvoiceGenerationStrategy
{
    /**
     * @param Contract $contract
     * @param int $month
     * @param int $year
     * @return Invoice[]
     */
    public function generate(Contract $contract, int $month, int $year): array
    {
        $invoices = [];
        $period   = 0;

        $referenceDate   = $contract->date->copy();

        $amount = (int) ($contract->amount / $contract->periods);

        while ($period < $contract->periods) {

            if ($contract->dateIsMatch($month, $year)) {
                $invoices[] = new Invoice(
                    date: $referenceDate->copy(),
                    amount: $amount
                );
            }

            $period++;
            $referenceDate->addMonth();
        }

        return $invoices;
    }
}
