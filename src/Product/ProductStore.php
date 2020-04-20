<?php

namespace SnowIO\OrderHiveDataModel\Product;

class ProductStore
{
    public static function of(?int $storeId): self
    {
        $item = new self($storeId);
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['store_id'] ?? null)
            ->withPrice($json['price'] ?? null);
    }

    public function toJson(): array
    {
        return [
            'store_id' => $this->storeId,
            'price' => $this->price
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof ProductStore) &&
        ($this->storeId === $object->storeId) &&
        ($this->price === $object->price);
    }

    private $storeId;
    private $price;

    private function __construct(?int $storeId)
    {
        $this->storeId = $storeId;
    }

    public function withStoreId(?int $storeId): self
    {
        $result = clone $this;
        $result->storeId = $storeId;
        return $result;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
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
