<?php

namespace SnowIO\OrderHiveDataModel\PurchaseOrder;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

class PurchaseOrderItems implements \IteratorAggregate
{
    use SetTrait;

    public function get($purchaseOrderItem): ?PurchaseOrderItem
    {
        return $this->items[$purchaseOrderItem] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($group) {
            return PurchaseOrderItem::fromJson($group);
        }, $json));
    }

    private static function getKey(PurchaseOrderItem $purchaseOrderItem): ?string
    {
        return (string) $purchaseOrderItem->getId();
    }

    public function toJson(): array
    {
        return
            \array_map(function (PurchaseOrderItem $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(PurchaseOrderItem $group, PurchaseOrderItem $otherGroup) : bool
    {
        return $group->equals($otherGroup);
    }
}
