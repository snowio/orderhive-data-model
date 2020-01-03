<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class ListOrderItemSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($orderItemId): ?ListOrderItem
    {
        return $this->items[$orderItemId] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($item) {
            return ListOrderItem::fromJson($item);
        }, $json));
    }

    private static function getKey(ListOrderItem $orderItem): ?string
    {
        return (string) $orderItem->getItemId();
    }

    public function toJson(): array
    {
        return
            \array_map(function (ListOrderItem $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(ListOrderItem $item, ListOrderItem $otherItem) : bool
    {
        return $item->equals($otherItem);
    }
}
