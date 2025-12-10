<?php

declare(strict_types=1);

namespace App\Application\Decorators;

use App\Application\DTO\GenerateInvoicesInputDTO;
use App\Application\Interfaces\IGenerateInvoicesPresenter;
use App\Application\Interfaces\IInvoicesManager;
use App\Application\Managers\InvoicesManager;
use App\Application\Ports\IRequestLogger;

readonly class InvoicesManagerLogger implements IInvoicesManager
{
    public function __construct(
        private InvoicesManager $nextManager,
        private IRequestLogger $logger,
    ) {
    }


    public function generateInvoices(
        IGenerateInvoicesPresenter $invoicesPresenter,
        GenerateInvoicesInputDTO $input
    ): mixed {
        $this->logger->write([
            'UserAgent' => $input->userAgent
        ]);

        return $this->nextManager->generateInvoices($invoicesPresenter, $input);
    }
}
