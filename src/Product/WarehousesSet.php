<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Product;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class WarehousesSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($id): ?Warehouse
    {
        return $this->items[$id] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($warehouse) {
            return Warehouse::fromJson($warehouse);
        }, $json));
    }

    private static function getKey(Warehouse $warehouse): ?string
    {
        return (string) $warehouse->getWarehouseId();
    }

    public function toJson(): array
    {
        return
            \array_map(function (Warehouse $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(Warehouse $warehouse, Warehouse $otherWarehouse) : bool
    {
        return $warehouse->equals($otherWarehouse);
    }
}
