<?php

namespace SnowIO\OrderHiveDataModel\Order;

class Warehouse
{
    public static function of(?int $id): self
    {
        $item = new self($id);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['id'] ?? null)
            ->withIsDefault($json['is_default'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'is_default' => $this->isDefault
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof Warehouse) &&
        ($this->isDefault === $object->isDefault) &&
        ($this->id === $object->id);
    }

    private $id;
    private $isDefault;

    private function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function withId(?int $id): self
    {
        $result = clone $this;
        $result->id = $id;
        return $result;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function withIsDefault(?bool $isDefault): self
    {
        $result = clone $this;
        $result->isDefault = $isDefault;
        return $result;
    }

    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }
}
