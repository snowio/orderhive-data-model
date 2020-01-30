<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class ExtraItemSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($orderItemId): ?ExtraItem
    {
        return $this->items[$orderItemId] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($item) {
            return ExtraItem::fromJson($item);
        }, $json));
    }

    private static function getKey(ExtraItem $orderItem): ?string
    {
        return (string) $orderItem->getName();
    }

    public function toJson(): array
    {
        return
            \array_map(function (ExtraItem $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(ExtraItem $item, ExtraItem $otherItem) : bool
    {
        return $item->equals($otherItem);
    }
}
