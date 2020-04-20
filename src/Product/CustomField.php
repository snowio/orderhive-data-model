<?php

namespace SnowIO\OrderHiveDataModel\Product;

class CustomField
{
    public static function of(?string $id): self
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
            ->withValue($json['value'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof CustomField) &&
        ($this->id === $object->id) &&
        ($this->value === $object->value);
    }

    private $id;
    private $value;

    private function __construct(?string $id)
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function withValue(?string $value): self
    {
        $result = clone $this;
        $result->value = $value;
        return $result;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
