<?php

declare(strict_types=1);

namespace App\Core\Application\UseCases;

use App\Core\Application\DTO\GenerateInvoicesInputDTO;
use App\Core\Application\DTO\GenerateInvoicesOutputDTO;
use App\Core\Domain\Ports\IContractsRepository;

readonly class GenerateInvoicesUseCase
{
    public function __construct(
        private IContractsRepository $contractsRepository
    ) {
    }

    /**
     * @param GenerateInvoicesInputDTO $input
     * @return GenerateInvoicesOutputDTO[]
     */
    public function execute(GenerateInvoicesInputDTO $input): array
    {
        $output    = [];

        $contracts = $this->contractsRepository->listContracts();

        foreach ($contracts as $contract) {
            foreach ($contract->generateInvoices($input->paymentType, $input->month, $input->year) as $invoice) {
                $output[] = GenerateInvoicesOutputDTO::makeFromInvoice($invoice);
            }
        }

        return $output;
    }
}
