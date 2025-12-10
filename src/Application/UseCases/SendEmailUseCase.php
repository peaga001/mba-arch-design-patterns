<?php

namespace App\Application\UseCases;

use App\Application\Ports\IMailer;

readonly class SendEmailUseCase
{
    public function __construct(
        private IMailer $mailer
    ) {
    }

    public function sendEmail(string $email, string $subject, string $message): void
    {
        $this->mailer->sendEmail($email, $subject, $message);
    }
}
