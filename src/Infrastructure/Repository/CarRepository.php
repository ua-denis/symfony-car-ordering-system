<?php

namespace App\Infrastructure\Repository;

use App\Contracts\Repository\CarRepositoryInterface;
use App\Domain\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;

class CarRepository implements CarRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Car $car): void
    {
        $this->entityManager->persist($car);
        $this->entityManager->flush();
    }
}