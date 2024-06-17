<?php

namespace App\Contracts\Factory;

use App\Domain\Entity\Car;

interface CarFactoryInterface
{
    public function createCar(
        string $engineType,
        string $engineSize,
        string $transmissionType,
        int $transmissionSpeeds,
        string $body,
        string $color,
        string $interior,
        array $options
    ): Car;
}