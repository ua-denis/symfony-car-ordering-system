<?php

namespace App\Domain\Entity;

class Engine
{
    private string $type;
    private string $size;

    public function __construct(string $type, string $size)
    {
        $this->type = $type;
        $this->size = $size;
    }

    public function getDescription(): string
    {
        return "$this->type $this->size";
    }
}