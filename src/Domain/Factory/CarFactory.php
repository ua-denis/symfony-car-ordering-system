<?php

namespace App\Domain\Factory;

use App\Domain\Entity\Car;
use InvalidArgumentException;

class CarFactory
{
    private array $factories = [];

    public function __construct(array $factories)
    {
        $this->factories = $factories;
    }

    public function createCar(
        string $type,
        string $engineType,
        string $engineSize,
        string $transmissionType,
        int $transmissionSpeeds,
        string $body,
        string $color,
        string $interior,
        array $options
    ): Car {
        if (!isset($this->factories[$type])) {
            throw new InvalidArgumentException("Unknown car type: $type");
        }

        return $this->factories[$type]->createCar(
            $engineType,
            $engineSize,
            $transmissionType,
            $transmissionSpeeds,
            $body,
            $color,
            $interior,
            $options
        );
    }
}