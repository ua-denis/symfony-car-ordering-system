<?php

namespace App\Domain\Entity;

abstract class Car
{
    protected static string $CAR_TYPE = 'Car';
    private Engine $engine;
    private Transmission $transmission;
    private string $body;
    private string $color;
    private string $interior;
    private array $options;

    public function __construct(
        Engine $engine,
        Transmission $transmission,
        string $body,
        string $color,
        string $interior,
        array $options
    ) {
        $this->engine = $engine;
        $this->transmission = $transmission;
        $this->body = $body;
        $this->color = $color;
        $this->interior = $interior;
        $this->options = $options;
    }

    public function printCharacteristics(): string
    {
        return sprintf(
            "Type of Car: %s\nEngine: %s\nTransmission: %s\nBody: %s\nColor: %s\nInterior: %s\nOptions: %s\n",
            static::$CAR_TYPE,
            $this->engine->getDescription(),
            $this->transmission->getDescription(),
            $this->body,
            $this->color,
            $this->interior,
            implode(', ', $this->options)
        );
    }
}