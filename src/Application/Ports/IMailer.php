<?php

namespace App\Application\Ports;

interface IMailer
{
    public function sendEmail(string $email, string $subject, string $message): void;
}
