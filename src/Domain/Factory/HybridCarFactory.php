<?php

namespace App\Domain\Factory;

use App\Contracts\Factory\CarFactoryInterface;
use App\Domain\Entity\Car;
use App\Domain\Entity\CarTypes\HybridCar;
use App\Domain\Entity\Engine;
use App\Domain\Entity\Transmission;

class HybridCarFactory implements CarFactoryInterface
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
    ): Car {
        $engine = new Engine($engineType, $engineSize);
        $transmission = new Transmission($transmissionType, $transmissionSpeeds);

        return new HybridCar($engine, $transmission, $body, $color, $interior, $options);
    }
}