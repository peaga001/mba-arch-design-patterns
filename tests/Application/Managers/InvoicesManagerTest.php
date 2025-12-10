<?php

declare(strict_types=1);

namespace Tests\Application\Managers;

use App\Application\DTO\GenerateInvoicesInputDTO;
use App\Application\Managers\InvoicesManager;
use App\Application\Presenters\CsvInvoicesPresenter;
use App\Application\Presenters\JsonInvoicesPresenter;
use App\Domain\Enums\PaymentType;
use Tests\Support\BaseTestCases;
use Tests\Support\Invoices\GenerateInvoicesForTests;

class InvoicesManagerTest extends BaseTestCases
{
    use GenerateInvoicesForTests;

    private InvoicesManager $manager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockBasicContractAndPaymentInMemory1();

        $this->manager = new InvoicesManager($this->contractsRepository);
    }

    public function test_ShouldGenerateInvoicesWithJsonPresenter(): void
    {
        $input = GenerateInvoicesInputDTO::makeFromArray(data: [
            'month'        => 1,
            'year'         => 2022,
            'payment_type' => PaymentType::CASH->value
        ]);

        $json = $this->manager->generateInvoices(
            invoicesPresenter: new JsonInvoicesPresenter(),
            input: $input
        );

        $this->assertJson($json);
        $this->assertStringContainsString('2022-01-05', $json);
        $this->assertStringContainsString('6000', $json);
    }

    public function test_ShouldGenerateInvoicesWithCsvPresenter(): void
    {
        $input = GenerateInvoicesInputDTO::makeFromArray(data: [
            'month'        => 1,
            'year'         => 2022,
            'payment_type' => PaymentType::CASH->value
        ]);

        $csv = $this->manager->generateInvoices(
            invoicesPresenter: new CsvInvoicesPresenter(),
            input: $input
        );

        $this->assertIsString($csv);
        $this->assertStringContainsString("date,amount", $csv);
        $this->assertStringContainsString("2022-01-05,6000", $csv);
    }
}
