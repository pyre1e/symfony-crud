<?php

namespace App\DTO;

use App\Interfaces\DTO;
use App\DTO\ProductDTO;

class ProductCollectionDTO implements DTO
{
    public function __construct(
        private array $items
    ) {}

    public function toJson(): array
    {
        return array_map(fn($item) => (new ProductDTO($item))->toJson(), $this->items);
    }
}