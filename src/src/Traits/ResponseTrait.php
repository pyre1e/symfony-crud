<?php

namespace App\Traits;

use App\Interfaces\Error;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseTrait
{
    public function error(Error $error): JsonResponse
    {
        return new JsonResponse([
            'status' => 0,
            'error' => [
                'code' => $error->getCode(),
                'message' => $error->getMessage(),
                'data' => $error->getData()
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
