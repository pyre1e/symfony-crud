<?php

namespace App\Trait;

use App\Interface\Error;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseTrait
{
    public function error(Error $error): JsonResponse
    {
        return new JsonResponse([
            'status' => 0,
            'error' => [
                'code' => $error->getCode(),
                'description' => $error->getDescription(),
                'details' => $error->getDetails()
            ]
        ]);
    }

    public function success(mixed $data = null): JsonResponse
    {
        return new JsonResponse([
            'status' => 1,
            'data' => $data
        ]);
    }
}
