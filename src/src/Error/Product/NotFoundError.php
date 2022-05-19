<?php

namespace App\Error\Product;

use App\Interface\Error;

class NotFoundError implements Error
{
    public function getCode(): int 
    {
        return 101;
    }

    public function getDescription(): string
    {
        return 'Product not found';
    }

    public function getDetails(): array
    {
        return [];
    }
}
