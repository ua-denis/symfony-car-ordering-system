<?php

namespace App\Contracts\Validation;

use App\Application\DTO\CarOrderDTO;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ValidationStrategyInterface
{
    public function validate(CarOrderDTO $dto): ConstraintViolationListInterface;
}