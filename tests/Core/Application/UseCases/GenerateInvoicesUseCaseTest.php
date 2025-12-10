<?php

declare(strict_types=1);

namespace Tests\Core\Application\UseCases;

use App\Core\Application\DTO\GenerateInvoicesInputDTO;
use App\Core\Application\UseCases\GenerateInvoicesUseCase;
use App\Core\Domain\Enums\PaymentType;
use Tests\Support\BaseTestCases;
use Tests\Support\Invoices\GenerateInvoicesForTests;

class GenerateInvoicesUseCaseTest extends BaseTestCases
{
    use GenerateInvoicesForTests;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockBasicContractAndPaymentInMemory1();
    }

    public function test_ShouldGenerateInvoicesWhenPaymentTypeIsCash(): void
    {
        $useCase  = new GenerateInvoicesUseCase(
            contractsRepository: $this->contractsRepository
        );

        $input = GenerateInvoicesInputDTO::makeFromArray(data: [
            'month'        => 1,
            'year'         => 2022,
            'payment_type' => PaymentType::CASH->value
        ]);

        $output = $useCase->execute($input);

        $this->assertIsArray($output);
        $this->assertEquals('2022-01-05', $output[0]->date);
        $this->assertEquals(6000, $output[0]->amount);
    }

    public function test_ShouldGenerateInvoicesWhenPaymentTypeIsAccrual(): void
    {
        $useCase  = new GenerateInvoicesUseCase(
            contractsRepository: $this->contractsRepository
        );

        $input = GenerateInvoicesInputDTO::makeFromArray(data: [
            'month'        => 1,
            'year'         => 2022,
            'payment_type' => PaymentType::ACCRUAL->value
        ]);

        $output = $useCase->execute($input);

        $this->assertIsArray($output);
        $this->assertEquals('2022-01-01', $output[0]->date);
        $this->assertEquals(500, $output[0]->amount);
    }
}
