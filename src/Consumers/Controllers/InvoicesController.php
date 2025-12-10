<?php

declare(strict_types=1);

namespace App\Consumers\Controllers;

use App\Consumers\Presenters\JsonInvoicesPresenter;
use App\Core\Application\DTO\GenerateInvoicesInputDTO;
use App\Core\Application\Ports\IGenerateInvoicesPresenter;
use App\Core\Application\Ports\IInvoicesManager;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

readonly class InvoicesController
{
    private IGenerateInvoicesPresenter $presenter;

    public function __construct(
        private IInvoicesManager $invoicesManager
    ) {
        $this->presenter = new JsonInvoicesPresenter();
    }

    public function generateInvoices(Request $request): Response
    {
        $requestData = json_decode($request->getBody()->getContents(), true);

        $content = $this->invoicesManager->generateInvoices(
            invoicesPresenter: $this->presenter,
            input: GenerateInvoicesInputDTO::makeFromArray($requestData)
        );

        return new Response(status: 200, body: $content);
    }
}
