<?php

declare(strict_types=1);

namespace Tests\Core\Consumers\Controllers;

use App\Adapters\Logger\Loggers\InMemoryLogger;
use App\Consumers\Controllers\InvoicesController;
use App\Consumers\Decorators\InvoicesManagerLogger;
use App\Core\Application\Managers\InvoicesManager;
use App\Core\Domain\Enums\PaymentType;
use GuzzleHttp\Psr7\Request;
use Tests\Support\BaseTestCases;
use Tests\Support\Invoices\GenerateInvoicesForTests;

class InvoicesControllerTest extends BaseTestCases
{
    use GenerateInvoicesForTests;

    private InvoicesController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockBasicContractAndPaymentInMemory1();
    }

    public function test_ShouldGenerateInvoicesFromAPIWithoutLoggerDecorator(): void
    {
        $controller = new InvoicesController(
            invoicesManager: new InvoicesManager(
                contractsRepository: $this->contractsRepository
            )
        );

        $request = new Request(
            method: 'POST',
            uri: '/generate-invoices',
            body: json_encode([
                'month'        => 1,
                'year'         => 2022,
                'payment_type' => PaymentType::CASH->value
            ])
        );

        $response = $controller->generateInvoices($request);
        $contents = $response->getBody()->getContents();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertStringContainsString('2022-01-05', $contents);
        $this->assertStringContainsString('6000', $contents);
    }

    public function test_ShouldGenerateInvoicesFromAPIWithLoggerDecorator(): void
    {
        $logger     = new InMemoryLogger();
        $controller = new InvoicesController(
            invoicesManager: new InvoicesManagerLogger(
                nextManager: new InvoicesManager(
                    contractsRepository: $this->contractsRepository
                ),
                logger: $logger
            )
        );

        $request = new Request(
            method: 'POST',
            uri: '/generate-invoices',
            body: json_encode([
                'month'        => 1,
                'year'         => 2022,
                'payment_type' => PaymentType::CASH->value,
                'user_agent'   => 'Chrome-Test'
            ])
        );

        $response = $controller->generateInvoices($request);
        $contents = $response->getBody()->getContents();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertStringContainsString('2022-01-05', $contents);
        $this->assertStringContainsString('6000', $contents);
        $this->assertEquals('{"UserAgent":"Chrome-Test"}', $logger->getMessage(0));
    }
}
