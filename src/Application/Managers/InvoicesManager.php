<?php

declare(strict_types=1);

namespace App\Application\Managers;

use App\Application\DTO\GenerateInvoicesInputDTO;
use App\Application\Interfaces\IGenerateInvoicesPresenter;
use App\Application\Interfaces\IInvoicesManager;
use App\Application\UseCases\GenerateInvoicesUseCase;
use App\Domain\Ports\IContractsRepository;

readonly class InvoicesManager implements IInvoicesManager
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
