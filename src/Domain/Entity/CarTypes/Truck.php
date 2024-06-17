<?php

namespace App\Domain\Entity\CarTypes;

use App\Domain\Entity\Car;

class Truck extends Car
{
    // Add specific methods and properties for Truck
    protected static string $CAR_TYPE = 'Truck';
}