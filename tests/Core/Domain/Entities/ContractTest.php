<?php

declare(strict_types=1);

namespace Tests\Core\Domain\Entities;

use App\Core\Domain\Entities\Contract;
use App\Core\Domain\Enums\PaymentType;
use Carbon\Carbon;
use Tests\Support\BaseTestCases;

class ContractTest extends BaseTestCases
{
    public function test_ShouldGenerateContractInvoices(): void
    {
        $contract = new Contract(
            id: $this->faker->uuid,
            description: $this->faker->word,
            amount: 6000,
            periods: 12,
            date: Carbon::make('2022-01-01T10:00:00')
        );

        $invoices = $contract->generateInvoices(
            paymentType: PaymentType::ACCRUAL,
            month: 1,
            year: 2022
        );

        $this->assertIsArray($invoices);
        $this->assertEquals('2022-01-01', $invoices[0]->date->toDateString());
        $this->assertEquals(500, $invoices[0]->amount);
    }
}
