<?php

namespace App\Interface;

interface Error
{
    public function getCode(): int;
    public function getDescription(): string;
    public function getDetails(): array;
}
