<?php

namespace App\DTO;

use App\Entity\Product as ProductEntity;
use App\Interfaces\DTO;

class ProductDTO implements DTO
{
    public function __construct(
        private ProductEntity $entity
    ) {}

    public function toJson(): array
    {
        return [
            'id' => $this->entity->getId(),
            'name' => $this->entity->getName(),
            'price' => $this->entity->getPrice()
        ];
    }
}
