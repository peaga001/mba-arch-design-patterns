<?php

declare(strict_types=1);

namespace App\Core\Domain\Strategies\InvoiceGeneration;

use App\Core\Domain\Entities\Contract;
use App\Core\Domain\Entities\Invoice;
use App\Core\Domain\Interfaces\InvoiceGenerationStrategy;

class CashBasisStrategy implements InvoiceGenerationStrategy
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

        foreach ($contract->payments as $payment) {
            if ($contract->dateIsMatch($month, $year)) {
                $invoices[] = new Invoice(
                    date: $payment->date,
                    amount: $payment->amount
                );
            }
        }

        return $invoices;
    }
}
