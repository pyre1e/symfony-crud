<?php

namespace App\Errors\Product;

use App\Interfaces\Error;

class NotFoundError extends Error
{
    public function getCode(): int 
    {
        return 101;
    }

    public function getMessage(): string
    {
        return 'Product not found';
    }
}
