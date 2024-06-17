<?php

namespace App\Domain\Entity;

class Transmission
{
    private string $type;
    private int $speeds;

    public function __construct(string $type, int $speeds)
    {
        $this->type = $type;
        $this->speeds = $speeds;
    }

    public function getDescription(): string
    {
        return "$this->type with $this->speeds speeds";
    }
}