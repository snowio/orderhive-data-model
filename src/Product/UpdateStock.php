<?php

namespace SnowIO\OrderHiveDataModel\Product;

class UpdateStock
{
    public static function of(?int $productId): self
    {
        $item = new self($productId);
        $item->warehouses = WarehousesSet::create();
        return $item;
    }

    public static function create(): self
    {
        return new self(null);
    }

    public static function fromJson($json): self
    {
        return self::of($json['product_id'] ?? null)
            ->withWarehouses(WarehousesSet::fromJson($json['warehouses'] ?? []));
    }

    public function toJson(): array
    {
        return [
            'product_id' => $this->productId,
            'warehouses' => $this->warehouses->toJson()
        ];
    }

    public function equals($object): bool
    {
        return ($object instanceof UpdateStock) &&
        ($this->productId === $object->productId) &&
        ($this->warehouses == $object->warehouses);
    }

    private $productId;
    private $warehouses;

    private function __construct(?int $id)
    {
        $this->productId = $id;
    }

    public function withProductId(?int $id): self
    {
        $result = clone $this;
        $result->productId = $id;
        return $result;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function withWarehouses(WarehousesSet $warehousesSet): self
    {
        $result = clone $this;
        $result->warehouses = $warehousesSet;
        return $result;
    }

    public function getWarehouses(): WarehousesSet
    {
        return $this->warehouses;
    }
}
