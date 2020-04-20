<?php

namespace SnowIO\OrderHiveDataModel\Product;

class ProductOption
{
    public static function of(?string $name): self
    {
        $item = new self($name);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['name'] ?? null)
            ->withPosition($json['position'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'name' => $this->name,
            'position' => $this->position
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof ProductOption) &&
        ($this->name === $object->name) &&
        ($this->position === $object->position);
    }

    private $name;
    private $position;

    private function __construct(?string $name)
    {
        $this->name = $name;
    }

    public function withName(?string $name): self
    {
        $result = clone $this;
        $result->name = $name;
        return $result;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function withPosition(?int $position): self
    {
        $result = clone $this;
        $result->position = $position;
        return $result;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }
}
