<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Domain\Entities\Invoice;

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
