<?php

declare(strict_types=1);

namespace Tests\Support\Invoices;

use App\Adapters\DB\DBConnections\InMemory\InMemoryConnection;
use App\Adapters\DB\Repositories\ContractsRepository;
use App\Adapters\DB\Repositories\PaymentsRepository;
use App\Core\Domain\Entities\Contract;
use App\Core\Domain\Entities\Payment;
use App\Core\Domain\Ports\IContractsRepository;
use Carbon\Carbon;

trait GenerateInvoicesForTests
{
    protected IContractsRepository $contractsRepository;

    public function mockBasicContractAndPaymentInMemory1(): void
    {
        $contractId = $this->faker->uuid;

        $dbConnection       = new InMemoryConnection();
        $paymentsRepository = new PaymentsRepository(
            dbConnection: $dbConnection
        );

        $this->contractsRepository = new ContractsRepository(
            dbConnection: $dbConnection,
            paymentsRepository: $paymentsRepository
        );

        $paymentsRepository->savePayment(
            payment: new Payment(
                paymentId: $this->faker->uuid,
                contractId: $contractId,
                amount: 6000,
                date: Carbon::parse('2022-01-05T10:00:00')
            )
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
}
