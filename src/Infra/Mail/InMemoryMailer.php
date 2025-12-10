<?php

namespace App\Infra\Mail;

use App\Application\Ports\IMailer;

class InMemoryMailer implements IMailer
{
    public function __construct(
        private array $mails = []
    ){}

    public function sendEmail(string $email, string $subject, string $message): void
    {
        $this->mails[] = [
            'email'   => $email,
            'subject' => $subject,
            'message' => $message
        ];
    }

    public function getMails(): array
    {
        return $this->mails;
    }

    public function getMail(int $index): array
    {
        return $this->mails[$index];
    }
}