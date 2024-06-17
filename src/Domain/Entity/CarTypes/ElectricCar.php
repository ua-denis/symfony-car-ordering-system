<?php

namespace App\Domain\Entity\CarTypes;

use App\Domain\Entity\Car;

class ElectricCar extends Car
{
    // Add specific methods and properties for ElectricCar
    protected static string $CAR_TYPE = 'Electric';
}