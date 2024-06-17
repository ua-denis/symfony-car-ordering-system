<?php

namespace App\Infrastructure\Validation;

use App\Application\DTO\CarOrderDTO;
use App\Contracts\Validation\ValidationStrategyInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DefaultValidationStrategy implements ValidationStrategyInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(CarOrderDTO $dto): ConstraintViolationListInterface
    {
        return $this->validator->validate($dto);
    }
}