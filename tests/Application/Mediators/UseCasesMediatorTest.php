<?php

declare(strict_types=1);

namespace Application\Mediators;

use App\Application\DTO\GenerateInvoicesInputDTO;
use App\Application\Mediators\UseCasesMediator;
use App\Application\UseCases\GenerateInvoicesUseCase;
use App\Application\UseCases\SendEmailUseCase;
use App\Domain\Enums\PaymentType;
use App\Infra\Mail\InMemoryMailer;
use Tests\Support\BaseTestCases;
use Tests\Support\Invoices\GenerateInvoicesForTests;

class UseCasesMediatorTest extends BaseTestCases
{
    use GenerateInvoicesForTests;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockBasicContractAndPaymentInMemory1();
    }

    public function test_ShouldGenerateInvoicesWithSendEmailUsingMediator(): void
    {
        $inMemoryMailer   = new InMemoryMailer();
        $sendEmailUseCase = new SendEmailUseCase($inMemoryMailer);

        $mediator = new UseCasesMediator();
        $mediator->addEventListener(
            'InvoicesGenerated',
            fn($payload) => $sendEmailUseCase->sendEmail($payload['email'], $payload['subject'], $payload['message'])
        );

        $generateInvoicesUseCase = new GenerateInvoicesUseCase(
            contractsRepository: $this->contractsRepository,
            mediator: $mediator
        );

        $input = GenerateInvoicesInputDTO::makeFromArray(data: [
            'month'        => 1,
            'year'         => 2022,
            'payment_type' => PaymentType::CASH->value,
            'email'        => 'generate-invoices@email.com'
        ]);

        $output = $generateInvoicesUseCase->execute($input);

        $this->assertIsArray($output);
        $this->assertCount(1, $inMemoryMailer->getMails());
        $this->assertEquals('generate-invoices@email.com', $inMemoryMailer->getMail(0)['email']);
        $this->assertEquals('Invoices', $inMemoryMailer->getMail(0)['subject']);
        $this->assertEquals('Invoices have been generated!', $inMemoryMailer->getMail(0)['message']);
    }

    public function test_ShouldGenerateInvoicesWithoutSendEmailUsingMediator(): void
    {
        $inMemoryMailer   = new InMemoryMailer();
        $sendEmailUseCase = new SendEmailUseCase($inMemoryMailer);

        $mediator = new UseCasesMediator();
        $mediator->addEventListener(
            'InvoicesExcluded',
            fn($payload) => $sendEmailUseCase->sendEmail($payload['email'], $payload['subject'], $payload['message'])
        );

        $generateInvoicesUseCase = new GenerateInvoicesUseCase(
            contractsRepository: $this->contractsRepository,
            mediator: $mediator
        );

        $input = GenerateInvoicesInputDTO::makeFromArray(data: [
            'month'        => 1,
            'year'         => 2022,
            'payment_type' => PaymentType::CASH->value,
            'email'        => 'generate-invoices@email.com'
        ]);

        $output = $generateInvoicesUseCase->execute($input);

        $this->assertIsArray($output);
        $this->assertCount(0, $inMemoryMailer->getMails());
    }
}