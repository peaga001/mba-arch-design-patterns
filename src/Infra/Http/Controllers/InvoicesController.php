<?php

declare(strict_types=1);

namespace App\Infra\Http\Controllers;

use App\Application\DTO\GenerateInvoicesInputDTO;
use App\Application\Interfaces\IGenerateInvoicesPresenter;
use App\Application\Interfaces\IInvoicesManager;
use App\Application\Presenters\JsonInvoicesPresenter;
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
