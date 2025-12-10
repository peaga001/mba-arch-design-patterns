<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Enums\PaymentType;
use App\Domain\Resolvers\InvoiceGenerationStrategyResolver;
use Carbon\Carbon;

class Contract
{
    public function __construct(
        public readonly string $id,
        public readonly string $description,
        public readonly int $amount,
        public readonly int $periods,
        public readonly Carbon $date,

        /* @param Payment[] $payments*/
        public array $payments = [],
    ) {
    }


    /**
     * @param PaymentType $paymentType
     * @param int $month
     * @param int $year
     * @return Invoice[]
     */
    public function generateInvoices(PaymentType $paymentType, int $month, int $year): array
    {
        $invoiceGenerationStrategy = InvoiceGenerationStrategyResolver::resolve($paymentType);
        return $invoiceGenerationStrategy->generate($this, $month, $year);
    }

    /**
     * @param int $month
     * @param int $year
     * @return bool
     */
    public function dateIsMatch(
        int $month,
        int $year
    ): bool {
        return $this->date->month === $month
            && $this->date->year === $year;
    }
}
