<?php

namespace App\Contracts\Service;

interface LogServiceInterface
{
    public function info(string $message, array $context = []): void;

    public function error(string $message, array $context = []): void;
}