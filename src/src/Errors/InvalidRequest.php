<?php

namespace App\Errors;

use App\Interfaces\Error;

class InvalidRequest extends Error
{
    public function getCode(): int
    {
        return 1;
    }

    public function getMessage(): string
    {
        return 'Invalid request';
    }

    public function getData(): array
    {
        $data = [];

        foreach ($this->data as $error) {
            $data[] = [
                'field' => substr($error->getPropertyPath(), 1, -1),
                'message' => $error->getMessage()
            ];
        }

        return $data;
    }
}
