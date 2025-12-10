<?php

declare(strict_types=1);

namespace App\Domain\Resolvers;

use App\Domain\Enums\PaymentType;
use App\Domain\Interfaces\InvoiceGenerationStrategy;
use App\Domain\Strategies\InvoiceGeneration\AccrualBasisStrategy;
use App\Domain\Strategies\InvoiceGeneration\CashBasisStrategy;

final class InvoiceGenerationStrategyResolver
{
    public static function resolve(PaymentType $paymentType): InvoiceGenerationStrategy
    {
        return match ($paymentType) {
            PaymentType::CASH    => new CashBasisStrategy(),
            PaymentType::ACCRUAL => new AccrualBasisStrategy()
        };
    }
}
