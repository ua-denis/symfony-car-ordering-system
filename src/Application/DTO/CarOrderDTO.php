<?php

namespace App\Application\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CarOrderDTO
{
    /**
     * @Assert\NotBlank()
     */
    private string $type;

    /**
     * @Assert\NotBlank()
     */
    private string $engineType;

    /**
     * @Assert\NotBlank()
     */
    private string $engineSize;

    /**
     * @Assert\NotBlank()
     */
    private string $transmissionType;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     */
    private int $transmissionSpeeds;

    /**
     * @Assert\NotBlank()
     */
    private string $body;

    /**
     * @Assert\NotBlank()
     */
    private string $color;

    /**
     * @Assert\NotBlank()
     */
    private string $interior;

    /**
     * @Assert\Type("array")
     */
    private array $options;

    public function __construct(
        string $type,
        string $engineType,
        string $engineSize,
        string $transmissionType,
        int $transmissionSpeeds,
        string $body,
        string $color,
        string $interior,
        array $options = []
    ) {
        $this->type = $type;
        $this->engineType = $engineType;
        $this->engineSize = $engineSize;
        $this->transmissionType = $transmissionType;
        $this->transmissionSpeeds = $transmissionSpeeds;
        $this->body = $body;
        $this->color = $color;
        $this->interior = $interior;
        $this->options = $options;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getEngineType(): string
    {
        return $this->engineType;
    }

    public function getEngineSize(): string
    {
        return $this->engineSize;
    }

    public function getTransmissionType(): string
    {
        return $this->transmissionType;
    }

    public function getTransmissionSpeeds(): int
    {
        return $this->transmissionSpeeds;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getInterior(): string
    {
        return $this->interior;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}