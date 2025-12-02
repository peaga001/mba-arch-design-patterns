<?php

declare(strict_types=1);

namespace App\Core\Domain\Interfaces;

use App\Core\Domain\Entities\Contract;
use App\Core\Domain\Entities\Invoice;

interface InvoiceGenerationStrategy
{
    /**
     * @param Contract $contract
     * @param int $month
     * @param int $year
     * @return Invoice[]
     */
    public function generate(Contract $contract, int $month, int $year): array;
}
