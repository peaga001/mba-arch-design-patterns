<?php

namespace Core\Application\UseCases;

use App\Adapters\DB\DBConnections\InMemory\InMemoryConnection;
use App\Adapters\DB\Repositories\ContractsRepository;
use App\Adapters\DB\Repositories\PaymentsRepository;
use App\Core\Application\DTO\GenerateInvoicesInputDTO;
use App\Core\Application\UseCases\GenerateInvoicesUseCase;
use App\Core\Domain\Entities\Contract;
use App\Core\Domain\Entities\Payment;
use App\Core\Domain\Enums\PaymentType;
use App\Core\Domain\Ports\IContractsRepository;
use Carbon\Carbon;
use Tests\Support\BaseTestCases;

class GenerateInvoicesUseCaseTest extends BaseTestCases
{
    private IContractsRepository $contractsRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $contractId = $this->faker->uuid;

        $dbConnection       = new InMemoryConnection();
        $paymentsRepository = new PaymentsRepository(
            dbConnection: $dbConnection
        );

        $paymentsRepository->savePayment(
            payment: new Payment(
                paymentId: $this->faker->uuid,
                contractId: $contractId,
                amount: 6000,
                date: Carbon::parse('2022-01-05T10:00:00')
            )
        );

        $this->contractsRepository = new ContractsRepository(
            dbConnection: $dbConnection,
            paymentsRepository: $paymentsRepository
        );

        $this->contractsRepository->saveContract(
            contract: new Contract(
                id: $contractId,
                description: $this->faker->word,
                amount: 6000,
                periods: 12,
                date: Carbon::parse('2022-01-01T10:00:00')
            )
        );
    }

    public function test_ShouldGenerateInvoicesWhenPaymentTypeIsCash(): void
    {
        $useCase  = new GenerateInvoicesUseCase(
            contractsRepository: $this->contractsRepository
        );

        $generateInvoicesDTO = GenerateInvoicesInputDTO::makeFromArray(data: [
            'month'        => 1,
            'year'         => 2022,
            'payment_type' => PaymentType::CASH->value
        ]);

        $output = $useCase->execute($generateInvoicesDTO);

        $this->assertIsArray($output);
        $this->assertEquals('2022-01-05', $output[0]->date);
        $this->assertEquals(6000, $output[0]->amount);
    }

    public function test_ShouldGenerateInvoicesWhenPaymentTypeIsAccrual(): void
    {
        $useCase  = new GenerateInvoicesUseCase(
            contractsRepository: $this->contractsRepository
        );

        $generateInvoicesDTO = GenerateInvoicesInputDTO::makeFromArray(data: [
            'month'        => 1,
            'year'         => 2022,
            'payment_type' => PaymentType::ACCRUAL->value
        ]);

        $output = $useCase->execute($generateInvoicesDTO);

        $this->assertIsArray($output);
        $this->assertEquals('2022-01-01', $output[0]->date);
        $this->assertEquals(500, $output[0]->amount);
    }
}
