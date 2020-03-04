<?php

namespace SnowIO\OrderHiveDataModel\PurchaseOrder;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

class WarehouseLocations implements \IteratorAggregate
{
    use SetTrait;

    public function get($warehouseLocation): ?WarehouseLocation
    {
        return $this->items[$warehouseLocation] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($warehouseLocation) {
            return WarehouseLocation::fromJson($warehouseLocation);
        }, $json));
    }

    private static function getKey(WarehouseLocation $warehouseLocation): ?string
    {
        return (string) $warehouseLocation->getBatch();
    }

    public function toJson(): array
    {
        return \array_map(function (WarehouseLocation $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(
        WarehouseLocation $warehouseLocation,
        WarehouseLocation $otherWarehouseLocation) : bool
    {
        return $warehouseLocation->equals($otherWarehouseLocation);
    }
}
