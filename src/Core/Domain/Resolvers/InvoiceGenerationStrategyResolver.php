<?php

declare(strict_types=1);

namespace App\Core\Domain\Resolvers;

use App\Core\Domain\Enums\PaymentType;
use App\Core\Domain\Interfaces\InvoiceGenerationStrategy;
use App\Core\Domain\Strategies\InvoiceGeneration\AccrualBasisStrategy;
use App\Core\Domain\Strategies\InvoiceGeneration\CashBasisStrategy;

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
