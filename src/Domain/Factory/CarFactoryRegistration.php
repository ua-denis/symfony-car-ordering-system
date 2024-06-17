<?php

namespace App\Domain\Factory;

class CarFactoryRegistration
{
    public static function createCarFactory(): CarFactory
    {
        $factories = [
            'SUV' => new SUVFactory(),
            'Truck' => new TruckFactory(),
            'Electric' => new ElectricCarFactory(),
            'Hybrid' => new HybridCarFactory(),
            'Luxury' => new LuxuryCarFactory()
        ];

        return new CarFactory($factories);
    }
}