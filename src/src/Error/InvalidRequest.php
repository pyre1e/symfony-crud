<?php

namespace App\Error;

use App\Interface\Error;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class InvalidRequest implements Error
{
    public function __construct(
        private ConstraintViolationListInterface $errors
    ) {}

    public function getCode(): int
    {
        return 1;
    }

    public function getDescription(): string
    {
        return 'Invalid request';
    }

    public function getDetails(): array
    {
        return array_map(fn($error) => [
            'field' => substr($error->getPropertyPath(), 1, -1),
            'message' => $error->getMessage()
        ], (array)$this->errors);
    }
}
