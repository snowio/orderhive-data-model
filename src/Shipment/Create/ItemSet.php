<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Shipment\Create;

use SnowIO\OrderHiveDataModel\Internal\SetTrait;

final class ItemSet implements \IteratorAggregate
{
    use SetTrait;

    public static function fromJson(array $items)
    {
        return self::of(array_map(static function (array $item) {
            return Item::fromJson($item);
        }, $items));
    }

    public static function getKey(Item $item): ?string
    {
        return (string) $item->getItemId();
    }

    public function toJson(): array
    {
        return array_map(static function (Item $item) {
            return $item->toJson();
        }, array_values($this->items));
    }

    public static function itemsAreEqual(Item $item, Item $other): bool
    {
        return $item->equals($other);
    }
}
