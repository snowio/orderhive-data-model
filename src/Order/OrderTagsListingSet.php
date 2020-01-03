<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Order;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class OrderTagsListingSet implements \IteratorAggregate
{
    use SetTrait;

    public function get($id): ?OrderTagsListing
    {
        return $this->items[$id] ?? null;
    }

    public static function fromJson(array $json): self
    {
        return self::of(array_map(function ($item) {
            return OrderTagsListing::fromJson($item);
        }, $json));
    }

    private static function getKey(OrderTagsListing $tag): ?string
    {
        return (string) $tag->getId();
    }

    public function toJson(): array
    {
        return
            \array_map(function (OrderTagsListing $item) {
                return $item->toJson();
            }, array_values($this->items));
    }

    private static function itemsAreEqual(OrderTagsListing $item, OrderTagsListing $otherItem) : bool
    {
        return $item->equals($otherItem);
    }
}
