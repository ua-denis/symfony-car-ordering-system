<?php

namespace App\Contracts\Service;

use App\Domain\Entity\Car;

interface EmailServiceInterface
{
    public function sendOrderConfirmation(string $to, Car $car): void;
}