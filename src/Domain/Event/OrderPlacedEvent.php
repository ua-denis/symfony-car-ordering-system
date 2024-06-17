<?php

namespace App\Domain\Event;

use App\Domain\Entity\Car;

class OrderPlacedEvent extends Event
{
    private Car $car;

    public function __construct(Car $car)
    {
        parent::__construct();
        $this->car = $car;
    }

    public function getCar(): Car
    {
        return $this->car;
    }
}