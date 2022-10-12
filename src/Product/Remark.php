<?php

namespace SnowIO\OrderHiveDataModel\Product;

class Remark
{
    public static function of(?string $source, ?string $desc = null): self
    {
        $item = new self($source, $desc);
        return $item;
    }

    public static function create(): self
    {
        return new self(null, null);
    }


    public static function fromJson($json): self
    {
        return self::of($json['source'] ?? null, $json['desc'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'source' => $this->source,
            'desc' => $this->desc,
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof Remark) &&
        ($this->source === $object->source) &&
        ($this->desc === $object->desc);
    }

    private $source;
    private $desc;

    private function __construct(?string $source, ?string $desc = null)
    {
        $this->source = $source;
        $this->desc = $desc;
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

    public function withDesc(?string $desc): self
    {
        $result = clone $this;
        $result->desc = $desc;
        return $result;
    }

    public function getDesc(): ?string
    {
        return $this->desc;
    }
}
