<?php

declare(strict_types=1);

namespace App\Consumers\Decorators;

use App\Consumers\Ports\IRequestLogger;
use App\Core\Application\DTO\GenerateInvoicesInputDTO;
use App\Core\Application\Managers\InvoicesManager;
use App\Core\Application\Ports\IGenerateInvoicesPresenter;
use App\Core\Application\Ports\IInvoicesManager;

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
