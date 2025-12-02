<?php

declare(strict_types=1);

namespace App\Adapters\DB\Repositories;

use App\Adapters\DB\Constants\TableConstants;
use App\Adapters\DB\DBConnections\IDBConnection;
use App\Core\Domain\Entities\Contract;
use App\Core\Domain\Ports\IContractsRepository;
use App\Core\Domain\Ports\IPaymentsRepository;
use Carbon\Carbon;

final readonly class ContractsRepository implements IContractsRepository
{
    public function __construct(
        private IDBConnection $dbConnection,
        private IPaymentsRepository $paymentsRepository
    ) {
    }

    /**
     * @return Contract[]
     */
    public function listContracts(): array
    {
        $contracts = [];

        $contractsData = $this->dbConnection->get(table: TableConstants::CONTRACTS);

        foreach ($contractsData as $contractData) {
            $contracts[] = new Contract(
                id: $contractData['id'],
                description: $contractData['description'],
                amount: $contractData['amount'],
                periods: $contractData['periods'],
                date: Carbon::make($contractData['date']),
                payments: $this->paymentsRepository->listContractPayments($contractData['id'])
            );
        }

        return $contracts;
    }

    public function saveContract(Contract $contract): void
    {
        $this->dbConnection->save(
            table: TableConstants::CONTRACTS,
            values: [
                'id'          => $contract->id,
                'description' => $contract->description,
                'amount'      => $contract->amount,
                'periods'     => $contract->periods,
                'date'        => $contract->date->format('Y-m-dTH:i:s'),
            ]
        );
    }
}
