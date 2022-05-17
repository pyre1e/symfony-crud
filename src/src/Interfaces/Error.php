<?php

namespace App\Interfaces;

abstract class Error
{
    public function __construct(
        protected mixed $data = null
    ) {}

    abstract public function getCode(): int;
    abstract public function getMessage(): string;

    public function getData(): mixed
    {
        return $this->data;
    }
}
