<?php

declare(strict_types=1);

namespace App\Core\Application\Managers;

use App\Core\Application\DTO\GenerateInvoicesInputDTO;
use App\Core\Application\Ports\IGenerateInvoicesPresenter;
use App\Core\Application\UseCases\GenerateInvoicesUseCase;
use App\Core\Domain\Ports\IContractsRepository;

readonly class InvoicesManager
{
    private GenerateInvoicesUseCase $generateInvoicesUseCase;

    /**
     * @param IContractsRepository $contractsRepository
     */
    public function __construct(
        private IContractsRepository $contractsRepository,
    ) {
        $this->generateInvoicesUseCase = new GenerateInvoicesUseCase(
            contractsRepository: $this->contractsRepository
        );
    }

    /**
     * @param IGenerateInvoicesPresenter $invoicesPresenter
     * @param GenerateInvoicesInputDTO $input
     * @return mixed
     */
    public function generateInvoices(
        IGenerateInvoicesPresenter $invoicesPresenter,
        GenerateInvoicesInputDTO $input
    ): mixed {
        $output = $this->generateInvoicesUseCase->execute($input);
        return $invoicesPresenter->present(output: $output);
    }
}
