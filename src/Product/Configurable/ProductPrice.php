<?php

namespace SnowIO\OrderHiveDataModel\Product\Configurable;

class ProductPrice
{
    public static function of(?int $priceId): self
    {
        $item = new self($priceId);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['price_id'] ?? null)
            ->withPrice($json['price'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'price_id' => $this->priceId,
            'price' => $this->price
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof ProductPrice) &&
        ($this->priceId === $object->priceId) &&
        ($this->price === $object->price);
    }

    private $priceId;
    private $price;

    private function __construct(?int $priceId)
    {
        $this->priceId = $priceId;
    }

    public function withPriceId(?int $priceId): self
    {
        $result = clone $this;
        $result->priceId = $priceId;
        return $result;
    }

    public function getPriceId(): ?int
    {
        return $this->priceId;
    }

    public function withPrice(?string $price): self
    {
        $result = clone $this;
        $result->price = $price;
        return $result;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }
}
