<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Product;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class InventoryLevelsSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($warehouseId): ?InventoryLevels
    {
        return $this->items[$warehouseId] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($group) {
            return InventoryLevels::fromJson($group);
        }, $json));
    }

    private static function getKey(InventoryLevels $inventoryLevels): ?string
    {
        return (string) $inventoryLevels->getLocation();
    }

    public function toJson(): array
    {
        return
            \array_map(function (InventoryLevels $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(InventoryLevels $group, InventoryLevels $otherGroup) : bool
    {
        return $group->equals($otherGroup);
    }
}
