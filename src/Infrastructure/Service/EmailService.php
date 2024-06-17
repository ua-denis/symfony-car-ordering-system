<?php

namespace App\Infrastructure\Service;

use App\Contracts\Service\EmailServiceInterface;
use App\Domain\Entity\Car;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService implements EmailServiceInterface
{
    private static ?EmailService $instance = null;
    private MailerInterface $mailer;
    private string $fromEmail;

    private function __construct(MailerInterface $mailer, ParameterBagInterface $params)
    {
        $this->mailer = $mailer;
        $this->fromEmail = $params->get('app.email_from');
    }

    public static function getInstance(MailerInterface $mailer, ParameterBagInterface $params): EmailService
    {
        if (self::$instance === null) {
            self::$instance = new EmailService($mailer, $params);
        }

        return self::$instance;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendOrderConfirmation(string $to, Car $car): void
    {
        $email = (new Email())
            ->from($this->fromEmail)
            ->to($to)
            ->subject('Your Car Order Confirmation')
            ->text('Thank you for your order. Here are the details: '.$car->printCharacteristics());

        $this->mailer->send($email);
    }
}