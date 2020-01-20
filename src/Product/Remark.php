<?php

namespace SnowIO\OrderHiveDataModel\Product;

class Remark
{
    public static function of(?string $source): self
    {
        $item = new self($source);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }


    public static function fromJson($json): self
    {
        return self::of($json['source'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'source' => $this->source,
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof Remark) &&
        ($this->source === $object->source);
    }

    private $source;

    private function __construct(?string $source)
    {
        $this->source = $source;
    }

    public function withSource(?string $source): self
    {
        $result = clone $this;
        $result->source = $source;
        return $result;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }
}
