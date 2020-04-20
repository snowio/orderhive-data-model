<?php

namespace SnowIO\OrderHiveDataModel\Product;

class Category
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
        return self::of($json['name'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof Category) &&
        ($this->name === $object->name);
    }

    private $name;

    private function __construct(?string $name)
    {
        $this->name = $name;
    }
}
