<?php

declare(strict_types=1);

namespace App\Core\Application\DTO;

use App\Core\Domain\Entities\Invoice;

class GenerateInvoicesOutputDTO
{
    public function __construct(
        public string $date,
        public int $amount
    ) {
    }

    public static function makeFromInvoice(Invoice $invoice): self
    {
        return new self(
            date:   $invoice->date->toDateString(),
            amount: $invoice->amount
        );
    }
}
