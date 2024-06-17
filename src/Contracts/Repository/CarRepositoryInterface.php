<?php

namespace App\Contracts\Repository;

use App\Domain\Entity\Car;

interface CarRepositoryInterface
{
    public function save(Car $car): void;
}